<?php

namespace App\Enums\Users;

enum Role: string
{
    case Super_Admin = 'superadmin';
    case Admin = 'admin';
    case User = 'user';
    case Guest = 'guest';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }

    public static function values(): array
    {
        return [
            'Super_Admin' => 'superadmin',
            'Admin' => 'admin',
            'User' => 'user',
            'Guest' => 'guest',
        ];
    }
}
