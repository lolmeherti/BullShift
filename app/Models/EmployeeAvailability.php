<?php

namespace App\Models;

use App\Enums\EmployeeAvailabilityStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $user_fid
 * @property int $contract_type_fid
 * @property string $availability_status
 * @property float $hours_worked_per_day
 * @property float $max_hours_per_day
 * @property float $hours_worked_per_week
 * @property float $max_hours_per_week
 * @property float $hours_worked_this_month
 * @property float $max_hours_this_month
 * @property int $days_of_vacation_left
 * @property int $max_days_of_vacation
 */
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
        'contract_type_fid',
        'availability_status',
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

    /**
     * Availability Enum cast
     */
    protected $casts = [
        'status' => EmployeeAvailabilityStatusEnum::class
    ];
}
