<?php

namespace App\Livewire\Forms;

use App\Enums\Members\Location;
use App\Enums\Members\Title;
use App\Models\Party;
use Livewire\Form;

class PartyForm extends Form
{
    public Party $party;

    public $firstname = '';

    public $surname = '';

    public Title $title;

    public $gender = '';

    public $party_type = 'false';

    public $profession = '';

    public $email = '';

    public $mobile = '';

    public Location $location = Location::Kota_Kinabalu;

    public $branch;

    public $mailing_addr = '';

    public $deceased = false;

    public $member_since;

    public function rules()
    {
        return [
            'firstname' => [],
            'surname' => ['required'],
            'title' => [],
            'gender' => [],
            'party_type' => [],
            'profession' => [],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            'location' => ['required'],
            'branch' => ['required'],
            'mailing_addr' => [],
            'deceased' => ['required'],
            'member_since' => ['nullable:date', 'date_format:Y-m-d'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->party);

        $this->party->firstname = $this->firstname;
        $this->party->surname = $this->surname;
        $this->party->title = $this->title;
        $this->party->gender = $this->gender;
        $this->party->party_type = $this->party_type;
        $this->party->profession = $this->profession;
        $this->party->location = $this->location;
        $this->party->branch = $this->branch;
        $this->party->mobile = $this->mobile;
        $this->party->email = $this->email;
        $this->party->mailing_addr = $this->mailing_addr;
        $this->party->deceased = $this->deceased;
        $this->party->member_since = $this->member_since;

        $this->party->save();
    }

    // used when form being initialised on edit
    public function setParty($party = null)
    {
        if (! $party) {
            $this->party = Party::make();
        } else {
            $this->party = Party::find($party);

            $this->firstname = $this->party->firstname;
            $this->surname = $this->party->surname;
            $this->title = $this->party->title;
            $this->gender = $this->party->gender;
            $this->party_type = $this->party->party_type;
            $this->profession = $this->party->profession;
            $this->location = $this->party->location;
            $this->branch = $this->party->branch;
            $this->mobile = $this->party->mobile;
            $this->email = $this->party->email;
            $this->mailing_addr = $this->party->mailing_addr;
            $this->deceased = $this->party->deceased;
            $this->member_since = $this->party->member_since->format('Y-m-d');
        }
    }
}
