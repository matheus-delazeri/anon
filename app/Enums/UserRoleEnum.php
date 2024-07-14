<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case PARTICIPANT = 1;
    case MODERATOR = 2;
}
