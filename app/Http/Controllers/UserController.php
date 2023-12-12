<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe uma lista de todos os usuários
    */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Mostra o formulário de cadastro de um novo usuario
    */
    public function create()
    {
        return view ('admin.users.create');
    }
}
