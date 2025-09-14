<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberRoutine;
use App\Models\ExerciseCompletion;

class Routines extends Component
{
    public $routines = [];

    public $expandedRoutines = [];

    public function toggleExercises($routineId)
    {
        if (in_array($routineId, $this->expandedRoutines)) {
            $this->expandedRoutines = array_diff($this->expandedRoutines, [$routineId]);
        } else {
            $this->expandedRoutines[] = $routineId;
        }
    }

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
        $this->routines = $user->member
            ->routineAssignments()
            ->with('routine.exercises', 'trainer.user')
            ->get()
            ->map(function ($assignment) {
                $routine = $assignment->routine;
                $routine->trainer = $assignment->trainer;
                $routine->assigned_at = $assignment->assigned_at;
                $routine->exercises = $routine->exercises;
                $routine->member_routine_id = $assignment->id;

                return $routine;
            });
    }

    private function loadTrainerRoutines($user)
    {
        $this->routines = $user->trainer
            ->memberRoutines()
            ->with('routine.exercises', 'member.user')
            ->get()
            ->map(function ($assignment) {
                $routine = $assignment->routine;
                $routine->member = $assignment->member;
                $routine->assigned_at = $assignment->assigned_at;
                return $routine;
            });
    }

    private function loadAdminRoutines()
    {
        $this->routines = MemberRoutine::with('routine.exercises', 'trainer.user', 'member.user')->get()
            ->map(function ($assignment) {
                $routine = $assignment->routine;
                $routine->trainer = $assignment->trainer;
                $routine->member = $assignment->member;
                $routine->assigned_at = $assignment->assigned_at;
                return $routine;
            });
    }

    public function render()
    {
        return view('livewire.routines');
    }

    public function markCompleted($memberRoutineId, $exerciseId)
    {
        ExerciseCompletion::updateOrCreate(
            [
                'member_routine_id' => $memberRoutineId,
                'exercise_id' => $exerciseId,
            ],
            [
                'completed' => true,
                'completed_at' => now(),
            ]
        );
    }
}
