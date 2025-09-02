<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios con paginación
        $members = Member::paginate(10);

        // Retornar la vista con los usuarios
        return view('members.index', compact('members'));
    }
}
