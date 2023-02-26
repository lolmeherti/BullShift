<?php

namespace App\Http\Controllers;

use App\Mail\InvitationEmail;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
            ->leftJoin('users as u','e.user_fid', '=','u.id')
            ->leftJoin('job_designations as d','e.designation_fid','=','d.id')
            ->select('u.id as id','u.name','u.email','u.email_verified_at','u.created_at as date_sent','d.designation')
            ->get();

        return view('preparation.invitations.index',compact('invitedUsers'));
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
        return view('preparation.invitations.create',compact('designations','departments'));
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
        $userId = $this->createUserForEmployee($request->input('name'),$request->input('email'));

        //get contract_type_fid
        $contractTypeId = JobDesignationController::getContractFidByJobDesignationId($request->input('designation_fid'));

        if($userId)
        {
            //creating the employee
            $employee = new Employee();
            $employee->user_fid = $userId;
            $employee->contract_type_fid = $contractTypeId;
            $employee->designation_fid = intval($request->input('designation_fid'));
            $employee->department_fid = intval($request->input('department_fid'));
            $employee->wage_per_year = floatval($trimmedWage);

            $employeeId = $employee->save();
        }

       if(isset($employeeId))
       {
           //initiating their availability
           //this will always be a new employee
           $createdAvailability = EmployeeAvailabilityController::create($userId,$contractTypeId, $vacationDaysLeft);
       }

        //TODO: error handling
        return redirect()->back()->withSuccess('Invitation has been sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
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
     * @param  \App\Models\Employee  $employee
     * @return Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userId = intval($request->input('id'));
        User::destroy($userId);
        DB::table('employee_availabilities')
            ->where('user_fid','=',$userId)
            ->delete();
        DB::table('employees')
            ->where('user_fid','=',$userId)
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

        if($userId)
        {
            Mail::to($email)->send(new InvitationEmail($email, $unHashedPassword, $name));
        }
        return $user->id ?? 0;
    }
}
