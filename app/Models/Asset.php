<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Number;
use App\Enums\Assets\AssetType;
use App\Enums\Assets\AssetStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;
    protected $casts = [
        'asset_type' => AssetType::class,
        'status' => AssetStatus::class,
    ];

    public function acquiredValueForHumans()
    {
        return Number::currency($this->acquired_value);
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}