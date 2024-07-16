<?php

namespace App\Enums\Transactions;

enum Year : string
{
    case _9999 = 'Life';
    case _2020 = '2020';
    case _2022 = '2022';
    case _2023 = '2023';
    case _2024 = '2024';
    case _2025 = '2025';
    case _2021 = '2021';
    case _2026 = '2026';
    case _2027 = '2027';
    case _2028 = '2028';
    case _2029 = '2029';
    case _2030 = '2030';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }

    public function color()
    {
        return match ($this) {
            static::_9999 => 'green',
            static::_2020 => 'orange',
            static::_2021 => 'orange',
            static::_2022 => 'orange',
            static::_2023 => 'orange',
            static::_2024 => 'green',
        };
    }
}
