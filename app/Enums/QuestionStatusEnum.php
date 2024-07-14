<?php

namespace App\Enums;

enum QuestionStatusEnum: int
{
    case PENDING = 1;
    case ACCEPTED = 2;
    case DECLINED = 3;
    case ANSWERED = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::ACCEPTED => 'Accepted',
            self::DECLINED => 'Declined',
            self::ANSWERED => 'Answered'
        };
    }
}
