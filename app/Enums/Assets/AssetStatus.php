<?php

namespace App\Enums\Assets;

enum AssetStatus: string
{
    case Draft = 'draft';
    case Current = 'current';
    case Retired = 'retired';

    public function label()
    {
        return match ($this) {
            static::Draft => 'Draft',
            static::Current => 'Current',
            static::Retired => 'Retired',
        };
    }

    public function color()
    {
        return match ($this) {
            static::Draft => 'blue',
            static::Current => 'green',
            static::Retired => 'orange',
        };
    }
}
