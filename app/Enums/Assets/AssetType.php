<?php

namespace App\Enums\Assets;

enum AssetType: string
{
    case Property = 'property';
    case Shares = 'shares';
    case Gold = 'gold';
    case Account = 'account';
    case Car = 'car';
    case Caravan = 'caravan';
    case Boat = 'boat';
    case Membership = 'membership';
    case Mortgage = 'mortgage';
    case Credit_Card = 'credit_card';

    public function assetClass()
    {
        return match ($this) {
            static::Property => 'Asset',
             static::Shares => 'Asset',
             static::Gold => 'Asset',
             static::Account => 'Asset',
             static::Car => 'Asset',
             static::Caravan => 'Asset',
             static::Boat => 'Asset',
             static::Mortgage => 'Liability',
             static::Membership => 'Asset',
             static::Credit_Card => 'Liability',
        };
    }

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
