<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum UserRole: string 
{
    use Values;

    case ADMIN  = 'administrator';
    case PUBLIC = 'public';

    public function label() {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::PUBLIC => 'Public',
        };
    }
}