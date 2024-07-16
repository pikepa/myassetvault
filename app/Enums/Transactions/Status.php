<?php

namespace App\Enums\Transactions;

enum Status: string
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';
    case Failed = 'failed';
    case Refunded = 'refunded';

    public function label()
    {
        return match ($this) {
            static::Paid => 'Paid',
            static::Unpaid => 'Unpaid',
            static::Failed => 'Failed',
            static::Refunded => 'Refunded',
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
