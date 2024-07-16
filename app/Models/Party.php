<?php

namespace App\Models;

use App\Enums\Members\Location;
use App\Enums\Members\Title;
use App\Enums\Transactions\Membership;
use App\Enums\Transactions\Status;
use App\Enums\Transactions\Year;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Party extends Model
{
    use HasFactory;

    protected $casts = [
        //   'status' => Status::class,
        'trans_member' => Membership::class,
        'trans_year' => Year::class,
        'trans_status' => Status::class,
        'location' => Location::class,
        'title' => Title::class,
        'gender' => 'boolean',
        'party_type' => 'boolean',
        'deceased' => 'boolean',
        'member_since' => 'date:Y-m-d',
    ];

    public function getFullnameAttribute()
    {
        return ucwords($this->firstname.' '.$this->surname);
    }

    public function getDateForHumansAttribute()
    {
        return $this->member_since->format('M d, Y');
    }

    public function latest_transaction(): HasOne
    {
        return $this->hasOne(Transaction::class)->latest();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
