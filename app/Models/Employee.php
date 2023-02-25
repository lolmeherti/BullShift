<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_fid
 * @property int $contract_type_fid
 * @property int $designation_fid
 * @property int $department_fid
 * @property float $wage_per_year
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_fid',
        'contract_type_fid',
        'designation_fid',
        'department_fid',
        'wage_per_year',
    ];
}
