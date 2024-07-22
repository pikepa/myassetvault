<?php

namespace App\Enums\Common;

enum Month : string
{
    case January = 'Jan';
    case February = 'Feb';
    case March = 'Mar';
    case April = 'Apr';
    case May = 'May';
    case June = 'Jun';
    case July = 'Jul';
    case Aug = 'Aug';
    case Sept = 'Sept';
    case Oct = 'Oct';
    case Nov = 'Nov';
    case Dec = 'Dec';

    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
