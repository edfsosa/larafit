<?php

namespace App\Livewire\Plans;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $plans;

    public function mount()
    {
        $user = Auth::user();
        $member = $user->member;

        if ($member) {
            $this->plans = $member->assignedPlans()->with('plan', 'trainer')->get();
        } else {
            $this->plans = collect();
        }
    }

    public function render()
    {
        return view('livewire.plans.index');
    }
}
