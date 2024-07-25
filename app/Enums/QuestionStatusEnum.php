<?php

namespace App\Enums;

enum QuestionStatusEnum: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case DECLINED = 3;
    case ANSWERED = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return __(match($this) {
            self::PENDING => 'Pending Approval',
            self::APPROVED => 'Approved',
            self::DECLINED => 'Declined',
            self::ANSWERED => 'Answered'
        });
    }
}
