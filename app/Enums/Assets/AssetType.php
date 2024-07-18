<?php

namespace App\Enums\Assets;

enum AssetType: string
{
    case Shares = 'shares';
    case Property = 'property';
    case Gold = 'gold';
    case Account = 'account';

    public function label()
    {
        return match ($this) {
            static::Shares => 'Shares',
            static::Property => 'Property',
            static::Gold => 'Gold',
            static::Account => 'Account',
        };
    }
}
