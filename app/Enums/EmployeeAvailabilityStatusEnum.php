<?php

namespace App\Enums;

enum EmployeeAvailabilityStatusEnum:string
{
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
    case Expired = 'expired';
}
