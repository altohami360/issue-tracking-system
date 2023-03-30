<?php

namespace App\Enums;

enum UserRole: String
{
    case ADMIN = 'admin';
    case USER = 'user';
    case TECHNICAL = 'technical';
}
