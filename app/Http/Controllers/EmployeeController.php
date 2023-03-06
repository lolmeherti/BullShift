<?php

namespace App\Http\Controllers;

use App\Mail\InvitationEmail;
use App\Models\ContractType;
use App\Models\Department;
use App\Models\Employee;
use App\Models\JobDesignation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Ramsey\Collection\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        //
        return view('preparation.invitations.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function invitationsIndex(): View
    {
        $invitedUsers = DB::table('employees as e')
            ->leftJoin('users as u', 'e.user_fid', '=', 'u.id')
            ->leftJoin('job_designations as d', 'e.designation_fid', '=', 'd.id')
            ->select('u.id as id', 'u.name', 'u.email', 'u.email_verified_at', 'u.created_at as date_sent', 'd.designation')
            ->orderBy('u.name')
            ->get();

        return view('preparation.invitations.index', compact('invitedUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        //
        $designations = JobDesignationController::getAllJobDesignationsWithContract();
        $departments = DepartmentController::getAllDepartmentsWithManager();
        return view('preparation.invitations.create', compact('designations', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:users',
            'designation_fid' => 'required',
            'days_of_vacation_left' => 'required'
        ],
            [
                'days_of_vacation_left.required' => 'Remaining Vacation Days is required!',
                'designation_fid.required' => 'Designation is required!',
                'email.unique' => 'This E-Mail address already exists!',
            ]);

        //abs used because can't take away vacation days from non-existing user
        $vacationDaysLeft = abs($request->input('days_of_vacation_left'));

        $trimmedWage = str_replace(' ', '', $request->input('wage_per_year'));
        $trimmedWage = abs(intval($trimmedWage));

        //making a new user for the invited employee
        $userId = $this->createUserForEmployee($request->input('name'), $request->input('email'));

        //get contract_type_fid
        $contractTypeId = JobDesignationController::getContractFidByJobDesignationId($request->input('designation_fid'));

        if ($userId) {
            //creating the employee
            $employee = new Employee();
            $employee->user_fid = $userId;
            $employee->contract_type_fid = $contractTypeId;
            $employee->designation_fid = intval($request->input('designation_fid'));
            $employee->department_fid = intval($request->input('department_fid'));
            $employee->wage_per_year = floatval($trimmedWage);

            $employeeId = $employee->save();
        }

        if (isset($employeeId)) {
            //initiating their availability
            //this will always be a new employee
            $createdAvailability = EmployeeAvailabilityController::create($userId, $contractTypeId, $vacationDaysLeft);
        }

        //TODO: error handling
        return redirect()->back()->withSuccess('Invitation has been sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Employee $employee
     * @return Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userId = intval($request->input('id'));
        User::destroy($userId);
        DB::table('employee_availabilities')
            ->where('user_fid', '=', $userId)
            ->delete();
        DB::table('employees')
            ->where('user_fid', '=', $userId)
            ->delete();

        return redirect()->back()->withSuccess('Invitation has been revoked successfully!');
    }

    //strongly defer from making this function public

    /**
     * Creates a new user for an invited employee.
     *
     * @param string $name
     * @param string $email
     * @return int $userId
     */
    private function createUserForEmployee(string $name, string $email): int
    {
        $unHashedPassword = Str::random(15);
        $pw = Hash::make($unHashedPassword);
        $user = new User();
        $user->password = $pw;
        $user->email = $email;
        $user->name = $name;
        $userId = $user->save();

        //TODO: temporarily disconnected mailing for dev purposes
//        if($userId)
//        {
//            Mail::to($email)->send(new InvitationEmail($email, $unHashedPassword, $name));
//        }

        return $user->id ?? 0;
    }

    /**
     * @param array $employee
     * @return bool
     */
    private function isValidEmployee(array $employee): bool
    {
        $validator = Validator::make($employee, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'designation_id' => 'required|string',
            'contract_id' => 'required|string',
            'remaining_vacation_days' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Log::error('Invalid employee data: ' . $validator->errors()->first());
            return false;
        }

        return true;
    }

    /**
     * Saves a validated employee.
     * use isValidEmployee() first
     * only use this if the data is 100% validated and secure
     *
     * @param int $userId
     * @param int $contractId
     * @param int $designationId
     * @param int $departmentId
     * @param float $wage
     * @return bool
     */
    private function saveValidatedEmployee(
        int   $userId,
        int   $contractId,
        int   $designationId,
        int   $departmentId,
        float $wage
    ): bool
    {
        $employee = new Employee();
        $employee->user_fid = $userId;
        $employee->contract_type_fid = $contractId;
        $employee->designation_fid = $designationId;
        $employee->department_fid = $departmentId ?? null;
        $employee->wage_per_year = $wage ?? null;
        return $employee->save();
    }

    /**
     * This function renders the invitations upload view
     *
     * @return View
     */
    public function importView(): View
    {
        return view('preparation.invitations.group_invitations');
    }

    /**
     * This function is used to download the invitation excel template
     *
     * @return StreamedResponse
     */
    public function downloadInvitationsExcelTemplate(): StreamedResponse
    {
        $template = collect([
            ['Name' => '', 'Email' => '', 'Designation_Id' => '', 'Contract_Id' => '', 'Remaining_Vacation_Days' => '', 'Department_Id' => '', 'Wage' => '']
        ]);

        $designations = JobDesignation::select(DB::raw("CONCAT(designation, '_',id) as Designation"))
            ->orderBy('designation', 'ASC')
            ->get();
        $contracts = ContractType::select(DB::raw("CONCAT(contract_type, '_',id) as Contracts"))
            ->orderBy('contract_type', 'ASC')
            ->get();
        $departments = Department::select(DB::raw("CONCAT(department, '_',id) as Departments"))
            ->orderBy('department', 'ASC')
            ->get();

        $sheets = new SheetCollection([
            'Template' => $template,
            'Designations' => $designations,
            'Contracts' => $contracts,
            'Departments' => $departments
        ]);

        try {
            $excelFile = (new FastExcel($sheets));
            return $excelFile->download('InvitationsTemplate.xlsx');
        } catch (IOException|InvalidArgumentException|UnsupportedTypeException|WriterNotOpenedException $e) {
            Log::error($e->getMessage());
        }

        return response()->streamDownload('');
    }

    /**
     * This function is used to import users from a CSV file
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'InvitationFileUpload' => 'required|mimes:csv',
        ]);

        $invitedEmployees = $this->parseInvitedEmployeesFromCsv($request);

        foreach ($invitedEmployees as $employee) {
            //validate CSV data
            if (!$this->isValidEmployee($employee)) {
                continue;
            }

            //making a new user for the invited employee
            $userId = $this->createUserForEmployee($employee['name'], $employee['email']);

            if (!$userId || $userId == 0) {
                continue;
            }

            $this->saveEmployeeDataFromCsv($userId, $employee);
        }

        return redirect()->back()->with(['success'=>'Invitations sent successfully!']);
    }

    //TODO: make middleware for this
    //the way values are expected to arrive inside the CSV
    //is the contract name concatenated with the contract id
    //for example Full-Time_9
    //this would mean that in the DB, the contract type is full time and its id is 9
    //this is done for performance reasons, so that we don't have to query send off queries
    //with where conditions in order to gather all our fids
    /**
     * $stringId is expected to be a string in similar format to this: Some_9_Random-String#S_99
     * We only care about the underscore at the end and the integers following it
     * Those integers represent the primary key in the table
     * This function is used to extract the primary key for: contract_types, job_designations, departments
     * @param string $stringId
     * @return int
     */
    private function extractIntIdFromStringId(string $stringId): int
    {
        if (preg_match('/_\d+$/', $stringId, $match)) {
            return intval(substr($match[0], 1));
        }

        return 0;
    }

    /**
     * @param int $userId
     * @param array $employee
     * @return void
     */
    private function saveEmployeeDataFromCsv(int $userId, array $employee): void
    {
        //what we really want is the id, so we're clipping it off the end here
        $contractId = $this->extractIntIdFromStringId($employee['contract_id']);
        $designationId = $this->extractIntIdFromStringId($employee['designation_id']);
        $departmentId = $this->extractIntIdFromStringId($employee['department_id']);
        $vacationDays = intval($employee['remaining_vacation_days']);
        $trimmedWage = str_replace(' ', '', $employee['wage']);
        $trimmedWage = abs(intval($trimmedWage));

        if ($contractId && $designationId) {
            $this->saveValidatedEmployee($userId, $contractId, $designationId, $departmentId, $trimmedWage);
            EmployeeAvailabilityController::create($userId, $contractId, $vacationDays);
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Support\Collection
     */
    private function parseInvitedEmployeesFromCsv(Request $request): array|\Illuminate\Support\Collection
    {
        $invitedEmployees = [];

        if ($request->hasFile('InvitationFileUpload')) {
            $path = $request->file('InvitationFileUpload')->store('public/templates');
            $storagePath = storage_path('app/');

            try {
                $invitedEmployees = (new FastExcel)->configureCsv(',','"')->import($storagePath . $path, function ($line) {
                    return [
                        'name' => $line['Name'],
                        'email' => $line['Email'],
                        'designation_id' => $line['Designation_Id'],
                        'contract_id' => $line['Contract_Id'],
                        'remaining_vacation_days' => $line['Remaining_Vacation_Days'],
                        'department_id' => $line['Department_Id'],
                        'wage' => $line['Wage'],
                    ];
                });
            } catch (IOException|UnsupportedTypeException|ReaderNotOpenedException $e) {
                Log::error($e->getMessage());
            }
        }
        return $invitedEmployees;
    }
}
