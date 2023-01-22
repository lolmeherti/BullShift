<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAvailability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_fid',
        'availability_status',
        'contract_type_fid',
        'hours_worked_per_day',
        'max_hours_per_day',
        'hours_worked_per_week',
        'max_hours_per_week',
        'hours_worked_this_month',
        'max_hours_this_month',
        'days_of_vacation_left',
        'max_days_of_vacation',
        'created_at',
        'updated_at',
    ];

}
