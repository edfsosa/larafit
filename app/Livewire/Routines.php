<?php

namespace App\Livewire;

use App\Models\MemberRoutine;
use App\Models\Routine;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Routines extends Component
{

    public $routines = [];

    public function mount()
    {
        $user = Auth::user();
        if (!$user) return;
        if ($user && $user->member) {
            $this->routines = $user->member->routines()->with('exercises')->get();
            foreach ($this->routines as $routine) {
                $routine->trainer = \App\Models\Trainer::find($routine->pivot->trainer_id);
            }
        } elseif ($user && $user->trainer) {
            $this->routines = $user->trainer->routines()->with('exercises')->get();
            foreach ($this->routines as $routine) {
                $routine->member = \App\Models\Member::find($routine->pivot->member_id);
            }
        } else {
            $memberRoutines = MemberRoutine::with('routine.exercises', 'trainer', 'member')->get();
            $this->routines = $memberRoutines->map(function ($mr) {
                $routine = $mr->routine;
                $routine->trainer = $mr->trainer;
                $routine->member = $mr->member;
                $routine->assigned_at = $mr->assigned_at;
                $routine->status = $mr->status;
                $routine->notes = $mr->notes;
                return $routine;
            });
        }
    }

    public function render()
    {
        return view('livewire.routines');
    }
}
