<?php

namespace App\Domain\Enums;

enum Roles: string
{
    case ADMIN = 'ADMIN';
    case USER = 'USER';
}
