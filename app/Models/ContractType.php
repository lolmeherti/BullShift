<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;

    public function jobDesignations()
    {
        return $this->hasMany(JobDesignation::class, 'contract_type_fid', 'id');
    }

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
        'max_days_of_vacation_per_year',
    ];

}
