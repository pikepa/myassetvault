<?php

namespace App\Models;

use App\Enums\Transactions\Membership;
use App\Enums\Transactions\Status;
use App\Enums\Transactions\Year;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'membership_type' => Membership::class,
        'status' => Status::class,
        'year' => Year::class,
        'transaction_date' => 'date:Y-m-d',
    ];

    public function getDateForHumansAttribute()
    {
        return $this->transaction_date->format('M d, Y');
    }

    public function getAmountForHumansAttribute()
    {
        return Number::currency(($this->amount / 100), in: 'MYR');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}
