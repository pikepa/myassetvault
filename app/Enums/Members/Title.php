<?php

namespace App\Enums\Members;

enum Title: string
{
    case Dato = 'dato';
    case Datin = 'datin';
    case Dr = 'dr';
    case Mr = 'mr';
    case Mrs = 'mrs';
    case Ms = 'ms';
    case _ = '-';

    public function label()
    {
        return match ($this) {
            static::Dato => 'Dato',
            static::Datin => 'Datin',
            static::Dr => 'Dr',
            static::Mr => 'Mr',
            static::Mrs => 'Mrs',
            static::Ms => 'Ms',
            static::_ => 'Not Stated',
        };
    }
}
