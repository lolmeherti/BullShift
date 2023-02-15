<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $department
 * @property string $manager_name
 * @property int $manager_user_fid
 */
class Department extends Model
{
    use HasFactory;
}
