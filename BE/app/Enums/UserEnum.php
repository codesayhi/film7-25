<?php

namespace App\Enums;

/**
 * UserEnum
 *
 * @package App\Enums
 * @author
 */
enum UserEnum :string
{
    case Admin = 'admin';
    case User = 'user';
    case Moderator = 'moderator';
}
