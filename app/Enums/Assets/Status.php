<?php

namespace App\Enums\Assets;

enum Status: string
{
    case Draft = 'draft';
    case Confirmed = 'confirmed';
    case Disposed = 'disposed';

    public function label()
    {
        return match ($this) {
            static::Draft => 'Draft',
            static::Confirmed => 'Confirmed',
            static::Disposed => 'Disposed',
        };
    }

    public function color()
    {
        return match ($this) {
            static::Paid => 'green',
            static::Unpaid => 'blue',
            static::Failed => 'red',
            static::Refunded => 'orange',
        };
    }
}
