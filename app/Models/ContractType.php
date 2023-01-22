<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_fid',
        'contract_type',
        'min_hours_per_shift',
        'max_hours_per_week',
        'days_of_service_per_week',
        'max_days_of_vacation_per_year',
    ];

}
