<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        //fetching contract types
        $contracts = $this->getAllContractTypes();

        return view('preparation.contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        //
        return view('preparation.contracts.create');
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
            'contract_type' => 'required|unique:contract_types|max:255',
            'hours_per_week' => 'decimal:0,1|max:120|required',
            'min_shift_length' => 'decimal:0,1|required|min:1|max:48',
            'days_of_vacation_per_year' => 'integer|required',
            'break_length' => 'integer|required'
        ]);

        $contract = new ContractType();
        $contract->user_fid = Auth::id();
        $contract->contract_type = (string) $request->input('contract_type');
        $contract->min_hours_per_shift = (float) $request->input('min_shift_length');
        $contract->max_hours_per_week = (float) $request->input('hours_per_week');
        $contract->break_length_in_minutes = (int) $request->input('break_length');
        $contract->break_included = (string) $request->input('break_included') ?? "off";
        $contract->days_of_vacation_per_year = (int) $request->input('days_of_vacation_per_year');
        $contract->save();

        return redirect()->back()->withSuccess('Contract Type has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param ContractType $contractType
     * @return void
     */
    public function show(ContractType $contractType): void
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ContractType $contract
     * @return Application|Factory|View
     */
    public function edit(ContractType $contract): View|Factory|Application
    {
        //
        return view('preparation.contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ContractType $contract
     * @return RedirectResponse
     */
    public function update(Request $request, ContractType $contract): RedirectResponse
    {
        $request->validate([
            'contract_type' => 'required|max:255',
            'hours_per_week' => 'decimal:0,1|max:120|required',
            'min_shift_length' => 'decimal:0,1|required|min:1|max:48',
            'days_of_vacation_per_year' => 'integer|required',
            'break_length' => 'integer|required'
        ]);

        $contract->user_fid = Auth::id();
        $contract->contract_type = (string) $request->input('contract_type');
        $contract->min_hours_per_shift = (float)($request->input('min_shift_length'));
        $contract->max_hours_per_week = (float) $request->input('hours_per_week');
        $contract->break_length_in_minutes = (int) $request->input('break_length');
        $contract->break_included = (string) $request->input('break_included') ?? "off";
        $contract->days_of_vacation_per_year = (int) $request->input('days_of_vacation_per_year');
        $contract->update();

        return redirect()->back()->withSuccess('Contract Type has been changed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse | RedirectResponse
     */
    public function destroy(Request $request): JsonResponse | RedirectResponse
    {
        $contract = ContractType::find($request->input('id'));

        $contractDesignationsCount = $contract->jobDesignations->count();

        if ($contractDesignationsCount > 0 && !$request->input('deleteAnyway')) {
            return response()->json(['dependency' => 'This contract is associated with job designations. Please remove all association before deleting the contract.']);
        } else {
            $contract->delete();
            return redirect()->back()->with('success','Contract type deleted successfully.');
        }
    }

    /**
     * Fetches all contract types.
     *
     * @return Collection
     */
    public static function getAllContractTypes(): Collection
    {
        //unfortunately the DB is configured with "ONLY_FULL_GROUP_BY" by default
        //and at the moment, it is more difficult to keep track of DB configs
        //than it is to just add all the columns to the eloquent query
        //which is why this happened
       return DB::table("contract_types")
           ->select('contract_types.*',DB::raw('(SELECT COUNT(*) FROM employees WHERE employees.contract_type_fid = contract_types.id) as employee_count'))
           ->leftJoin('employees','employees.contract_type_fid','=','contract_types.id')
           ->groupBy(
               'contract_types.id',
               'contract_types.user_fid',
               'contract_types.contract_type',
               'contract_types.min_hours_per_shift',
               'contract_types.max_hours_per_week',
               'contract_types.break_length_in_minutes',
               'contract_types.break_included',
               'contract_types.days_of_vacation_per_year',
               'contract_types.created_at',
               'contract_types.updated_at')
           ->orderBy('contract_type')
           ->get();
    }
    
    /**
     * Fetches a contract type by its id.
     *
     * @return Collection
     */
    public static function getContractTypeById($contractTypeId): object
    {
        return DB::table('contract_types')
            ->where('id','=',$contractTypeId)
            ->first();
    }
}
