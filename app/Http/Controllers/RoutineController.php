<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    public function index()
    {
        // Obtener las rutinas del usuario autenticado
        $routines = Routine::where('trainer_id', Auth::id())->get();

        // Retornar la vista con las rutinas
        return view('routines.index', compact('routines'));
    }
}
