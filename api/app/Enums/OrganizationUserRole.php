<?php

namespace App\Enums;

enum OrganizationUserRole: string
{
    case ADMIN = 'admin';
    case MEMBER = 'member';
}
