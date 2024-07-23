<?php

namespace App\Enums\Assets;

enum Location: string
{
    case Australia = 'AUS';
    case South_Africa = 'SAR';
    case Great_Britain = 'GBR';
    case United_Arab_Emirates = 'UAE';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
