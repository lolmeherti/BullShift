<?php

namespace App\Http\Controllers;

use App\Models\JobDesignation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        //fetching job designations
        $designations = $this->getAllJobDesignationsWithContract();

        return view('preparation.designations.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        //fetching all contract types
        //these are needed for the dropdown in the create form
        $contractTypes = ContractTypeController::getAllContractTypes();

        return view('preparation.designations.create', compact('contractTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required|max:255',
            'contract_type_fid' => 'required',
        ]);

        $designation = new JobDesignation();
        $designation->user_fid = Auth::id();
        $designation->designation = $request->designation;
        $designation->contract_type_fid = $request->contract_type_fid;

        $designation->save();

        return redirect()->back()->withSuccess('Designation has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param JobDesignation $jobDesignation
     * @return Response
     */
    public function show(JobDesignation $jobDesignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobDesignation $jobDesignation
     * @return Application|Factory|View
     */
    public function edit(JobDesignation $jobDesignation): View|Factory|Application
    {
        $contractTypes = ContractTypeController::getAllContractTypes();

        return view('preparation.designations.edit', compact('contractTypes', 'jobDesignation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param JobDesignation $jobDesignation
     * @return Response
     */
    public function update(Request $request, JobDesignation $jobDesignation)
    {
        //
        $request->validate([
            'designation' => 'required|max:255',
            'contract_type_fid' => 'required',
        ]);

        $jobDesignation->user_fid = Auth::id();
        $jobDesignation->designation = $request->designation;
        $jobDesignation->contract_type_fid = $request->contract_type_fid;
        $jobDesignation->save();

        return redirect()->back()->withSuccess('Designation has been edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        //
        if($request->id)
        {
            JobDesignation::destroy($request->id);
        }
    }

    /**
     * Fetches all job designations
     *
     * @return Collection
     */
    public function getAllJobDesignationsWithContract(): Collection
    {
        return DB::table('job_designations')
            ->leftJoin('contract_types', 'job_designations.contract_type_fid', '=', 'contract_types.id')
            ->select('job_designations.*', 'contract_types.contract_type')
            ->get();
    }
}
