<?php

namespace App\Livewire;

use App\Models\MemberRoutine;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Routines extends Component
{
    public $routines = [];
    public $showExercises = false;

    public function mount()
    {
        $user = Auth::user();
        if (!$user) return;

        if ($user->member) {
            $this->loadMemberRoutines($user);
        } elseif ($user->trainer) {
            $this->loadTrainerRoutines($user);
        } else {
            $this->loadAdminRoutines();
        }
    }

    private function loadMemberRoutines($user)
    {
        $this->routines = $user->member->routines()
            ->with('exercises')
            ->get()
            ->map(function ($routine) {
                $routine->trainer = $routine->pivot->trainer ?? null;
                $routine->assigned_at = $routine->pivot->assigned_at ?? null;
                return $routine;
            });
    }

    private function loadTrainerRoutines($user)
    {
        $this->routines = $user->trainer->routines()
            ->with('exercises')
            ->get()
            ->map(function ($routine) {
                $routine->member = $routine->pivot->member ?? null;
                return $routine;
            });
    }

    private function loadAdminRoutines()
    {
        $this->routines = MemberRoutine::with('routine.exercises', 'trainer', 'member')
            ->get()
            ->map(function ($mr) {
                $routine = $mr->routine;
                $routine->trainer = $mr->trainer;
                $routine->member = $mr->member;
                $routine->assigned_at = $mr->assigned_at;
                $routine->status = $mr->status;
                $routine->notes = $mr->notes;
                return $routine;
            });
    }

    public function toggleExercises()
    {
        $this->showExercises = !$this->showExercises;
    }

    public function render()
    {
        return view('livewire.routines');
    }
}
