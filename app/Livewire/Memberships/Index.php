<?php

namespace App\Livewire\Memberships;

use App\Models\MemberMembership;
use App\Models\Membership;
use App\Models\Payment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $currentMembership;
    public $membershipHistory;
    public $daysLeft = null;

    public $membership_id = null;
    public $payment_method = null;

    public $availableMemberships;
    public $successMessage = null;

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

        if ($this->currentMembership) {
            $this->daysLeft = number_format(now()->diffInDays($this->currentMembership->end_date, false), 0);
        }

        $this->availableMemberships = Membership::all();
    }

    public function getCanAcquireMembershipProperty()
    {
        return $this->currentMembership === null;
    }

    public function render()
    {
        return view('livewire.memberships.index');
    }

    public function acquireMembership()
    {
        $this->validate([
            'membership_id' => 'required|exists:memberships,id',
            'payment_method' => 'required|string|max:100',
        ]);

        $membership = Membership::findOrFail($this->membership_id);
        $member = Auth::user()->member;

        DB::transaction(function () use ($member, $membership) {
            $start = now();
            $end = now()->addDays($membership->duration_days);

            $memberMembership = MemberMembership::create([
                'member_id' => $member->id,
                'membership_id' => $membership->id,
                'start_date' => $start,
                'end_date' => $end,
                'status' => 'pending',
            ]);

            Payment::create([
                'member_membership_id' => $memberMembership->id,
                'amount' => $membership->price,
                'method' => $this->payment_method,
                'date' => now(),
            ]);
        });

        session()->flash('success', 'Membresía adquirida correctamente.');
        return redirect()->route('memberships.index');
    }
}
