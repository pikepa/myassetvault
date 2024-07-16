<?php

namespace App\Enums\Transactions;

enum Membership: string
{
    case Ordinary = 'ord';
    case Life = 'lif';
    case Student = 'stu';
    case Institutional = 'inst';

    public function label()
    {
        return match ($this) {
            static::Ordinary => 'Ordinary Members',
            static::Life => 'Life Members',
            static::Student => 'Student Members',
            static::Institutional => 'Institutional Members',
        };
    }

    public function route()
    {
        return match ($this) {
            static::Ordinary => 'ord',
            static::Life => 'lif',
            static::Student => 'stu',
            static::Institutional => 'inst',
        };
    }

    public function color()
    {
        return match ($this) {
            static::Ordinary => 'green',
            static::Life => 'red',
            static::Student => 'blue',
            static::Institutional => 'orange',
        };
    }
}
