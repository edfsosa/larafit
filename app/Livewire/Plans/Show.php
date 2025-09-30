<?php

namespace App\Livewire\Plans;

use App\Models\MemberPlan;
use Livewire\Component;

class Show extends Component
{
    public MemberPlan $plan;

    public function mount($planId)
    {
        $this->plan = MemberPlan::with([
            'plan.phases.weeks.days.routine.exercises',
            'trainer',
        ])->findOrFail($planId);
    }

    public function render()
    {
        return view('livewire.plans.show');
    }
}
