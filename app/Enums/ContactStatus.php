<?php

namespace App\Enums;

enum ContactStatus: string
{
    case Unread = 'unread';
    case Read = 'read';
    case Solved = 'solved';

    public static function getStatuses() 
    {
        return [
            self::Unread, self::Read, self::Solved
        ];
    }
}