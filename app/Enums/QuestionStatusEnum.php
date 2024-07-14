<?php

namespace App\Enums;

enum QuestionStatusEnum: int
{
    case PENDING = 1;
    case ACCEPTED = 2;
    case DECLINED = 3;
    case ANSWERED = 4;
}
