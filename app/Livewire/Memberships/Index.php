<?php

namespace App\Livewire\Memberships;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $currentMembership;
    public $membershipHistory;
    public $daysLeft = null;

    public function mount()
    {
        $user = Auth::user();
        $member = $user->member;

        if ($member) {
            $this->currentMembership = $member->activeMemberMembership();
            $this->membershipHistory = $member->historicalMemberMemberships();
        } else {
            $this->currentMembership = null;
            $this->membershipHistory = collect();
        }
    }

    public function render()
    {
        return view('livewire.memberships.index');
    }
}
