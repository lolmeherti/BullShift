<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeAvailabilityStatusEnum;
use App\Models\ContractType;
use App\Models\EmployeeAvailability;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return bool
     */
    public static function create($userId, $contractTypeId, $vacationDaysLeft): bool
    {
        $contract = ContractTypeController::getContractTypeById($contractTypeId);

        $employeesAvailability = new EmployeeAvailability();
        $employeesAvailability->user_fid = $userId;
        $employeesAvailability->contract_type_fid = $contractTypeId;
        $employeesAvailability->availability_status = EmployeeAvailabilityStatusEnum::Pending;
        $employeesAvailability->hours_worked_per_day = 0;//for first instance
        $employeesAvailability->max_hours_per_day = floatval($contract->min_hours_per_shift);
        $employeesAvailability->hours_worked_per_week = 0;//for first instance
        $employeesAvailability->max_hours_per_week = floatval($contract->max_hours_per_week);
        $employeesAvailability->hours_worked_this_month = 0;//for first instance
        $employeesAvailability->max_hours_this_month = 0;//TODO: this needs to get calculated per month
        $employeesAvailability->days_of_vacation_left = $vacationDaysLeft;
        $employeesAvailability->max_days_of_vacation = $contract->days_of_vacation_per_year;
        return $employeesAvailability->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param EmployeeAvailability $employeeAvailability
     * @return Response
     */
    public function show(EmployeeAvailability $employeeAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EmployeeAvailability $employeeAvailability
     * @return Response
     */
    public function edit(EmployeeAvailability $employeeAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param EmployeeAvailability $employeeAvailability
     * @return Response
     */
    public function update(Request $request, EmployeeAvailability $employeeAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EmployeeAvailability $employeeAvailability
     * @return Response
     */
    public function destroy(EmployeeAvailability $employeeAvailability)
    {
        //
    }


}
