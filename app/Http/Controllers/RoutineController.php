<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    public function index()
    {
        // Obtener todas las rutinas del usuario autenticado con paginación
        $routines = Routine::where('trainer_id', Auth::id())->paginate(10);

        // Retornar la vista con las rutinas
        return view('routines.index', compact('routines'));
    }

    public function create()
    {
        // Obtener todos los entrenadores para desplegar en el select
        $trainers = Trainer::all();

        // Retornar la vista para crear un nuevo usuario
        return view('routines.create', compact('trainers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        Routine::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'trainer_id' => $validated['trainer_id'],
        ]);

        return redirect()->route('routines.index')->with('success', __('Routine created successfully.'));
    }

    public function edit(Routine $routine)
    {
        // Obtener todos los entrenadores para desplegar en el select
        $trainers = Trainer::all();
        // Retornar la vista para editar un usuario
        return view('routines.edit', compact('routine', 'trainers'));
    }

    public function update(Request $request, Routine $routine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $routine->update($validated);

        return redirect()->route('routines.index')->with('success', __('Routine updated successfully.'));
    }

    public function destroy(Routine $routine)
    {
        $routine->delete();
        return redirect()->route('routines.index')->with('success', __('Routine deleted successfully.'));
    }

    public function show(Routine $routine)
    {
        // Retornar la vista para mostrar los detalles de una rutina
        return view('routines.show', compact('routine'));
    }
}
