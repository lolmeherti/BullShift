<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed|string|null $user_fid
 * @property mixed $designation
 * @property mixed $contract_type_fid
 */
class JobDesignation extends Model
{
    use HasFactory;

    public function contractType()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_fid', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'designation',
        'contract_type_fid',
        'user_fid',
    ];
}
