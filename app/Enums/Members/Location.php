<?php

namespace App\Enums\Members;

enum Location: string
{
    case Kota_Kinabalu = 'kk';
    case Sandakan = 'sand';
    case Kooching = 'koo';
    case Kudat = 'kud';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
