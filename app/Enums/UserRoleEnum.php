<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case PARTICIPANT = 1;
    case MODERATOR = 2;
    case ADMIN = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::PARTICIPANT => 'Participant',
            self::MODERATOR => 'Moderator',
            self::ADMIN => 'Administrator'
        };
    }
}
