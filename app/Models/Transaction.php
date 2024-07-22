<?php

namespace App\Models;

use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Enums\Transactions\Membership;
use App\Enums\Transactions\Status;
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
        'month' => Month::class,
        'transaction_date' => 'date:Y-m-d',
    ];

    public function getDateForHumansAttribute()
    {
        return $this->transaction_date->format('M d, Y');
    }

    public function getCurrentValueForHumansAttribute()
    {
        return Number::currency(($this->current_value / 100), in: 'AUD');
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
