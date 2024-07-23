<?php

namespace App\Livewire\Forms;

use App\Enums\Assets\AssetStatus;
use App\Enums\Assets\AssetType;
use App\Enums\Assets\Location;
use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class AssetForm extends Form
{
    public Asset $asset;

    public $name;

    public AssetType $asset_type;

    public $description;

    public Location $location;

    public $qty;

    public $acquired_value;

    public Year $acquired_year;

    public Month $acquired_month;

    public $current_value;

    public $user_id;

    public AssetStatus $status;

    public $comments = '';

    public function rules()
    {
        return [
            'name' => ['required', 'min:5', 'max:50'],
            'qty' => ['required', 'integer'],
            'asset_type' => ['required'],
            'description' => ['required', 'min:20'],
            'location' => ['required'],
            'acquired_year' => ['required'],
            'acquired_month' => ['required'],
            'acquired_value' => ['required', 'integer'],
            'status' => ['required'],
            'user_id' => [''],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->asset->asset_type = $this->asset_type;
        $this->asset->qty = $this->qty;
        $this->asset->location = $this->location;
        $this->asset->name = $this->name;
        $this->asset->description = $this->description;
        $this->asset->qty = $this->qty;
        $this->asset->acquired_value = $this->acquired_value;
        $this->asset->acquired_year = $this->acquired_year;
        $this->asset->acquired_month = $this->acquired_month;
        $this->asset->status = $this->status;
        $this->asset->user_id = Auth::user()->id;

        $this->asset->save();
    }

    // used when form being initialised on edit
    public function setAsset($asset = null)
    {
        if (! $asset) {
            $this->asset = Asset::make();
        } else {
            $this->asset = Asset::find($asset);

            $this->asset_type = $this->asset->asset_type;
            $this->name = $this->asset->name;
            $this->description = $this->asset->description;
            $this->location = $this->asset->location;
            $this->qty = $this->asset->qty;
            $this->acquired_value = $this->asset->acquired_value;
            $this->acquired_year = $this->asset->acquired_year;
            $this->acquired_month = $this->asset->acquired_month;
            $this->user_id = $this->asset->user_id;
            $this->status = $this->asset->status;
        }
    }
}
