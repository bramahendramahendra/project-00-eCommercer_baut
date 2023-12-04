<?php

namespace App\Enums;

enum ContactStatus: string
{
    case Unread = 'Unread';
    case Read = 'read';

    public static function getStatuses() 
    {
        return [
            self::Unread, self::Read
        ];
    }
}