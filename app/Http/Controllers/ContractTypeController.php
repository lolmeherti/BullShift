<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function index()
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
    public function create()
    {
        //
        return view('preparation.contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'contract_type' => 'required|unique:contract_types|max:255',
            'hours_per_week' => 'decimal:0,1|max:120|required',
            'min_shift_length' => 'integer|required|min:1|max:48',
            'days_of_vacation_per_year' => 'integer|required',
            'break_length' => 'integer|required'
        ]);

        $contract = new ContractType();
        $contract->user_fid = Auth::id();
        $contract->contract_type = $request->contract_type;
        $contract->min_hours_per_shift = $request->min_shift_length + 0;
        $contract->max_hours_per_week = $request->hours_per_week + 0;
        $contract->break_length_in_minutes = $request->break_length;
        $contract->break_included = $request->break_included ?? "off";
        $contract->days_of_vacation_per_year = $request->days_of_vacation_per_year;
        $contract->save();

        return redirect()->back()->withSuccess('Contract Type has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param ContractType $contractType
     * @return Response
     */
    public function show(ContractType $contractType)
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
     * @param  \Illuminate\Http\Request  $request
     * @param ContractType $contract
     * @return Response
     */
    public function update(Request $request, ContractType $contract)
    {
        $request->validate([
            'contract_type' => 'required|max:255',
            'hours_per_week' => 'decimal:0,1|max:120|required',
            'min_shift_length' => 'integer|required|min:1|max:48',
            'days_of_vacation_per_year' => 'integer|required',
            'break_length' => 'integer|required'
        ]);

        $contract->user_fid = Auth::id();
        $contract->contract_type = $request->contract_type;
        $contract->min_hours_per_shift = $request->min_shift_length;
        $contract->max_hours_per_week = $request->hours_per_week;
        $contract->break_length_in_minutes = $request->break_length;
        $contract->break_included = $request->break_included ?? "off";
        $contract->days_of_vacation_per_year = $request->days_of_vacation_per_year;
        $contract->update();

        return redirect()->back()->withSuccess('Contract Type has been changed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function destroy(Request $request)
    {
        $contract = ContractType::find($request->id);

        $contractDesignationsCount = $contract->jobDesignations->count();

        if ($contractDesignationsCount > 0 && !$request->deleteAnyway) {
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
       return DB::table("contract_types")->get();
    }
}
