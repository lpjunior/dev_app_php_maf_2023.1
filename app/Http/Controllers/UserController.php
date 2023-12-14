<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Log;

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

    /**
     * Atualiza um administrador no banco de dados
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:8|max:255|confirmed',
            'type' => 'required|in:client,admin'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'type' => $validated['type']
        ]);

        Log::debug("[UserController][update] - Payload: {json_encode($user)}");
        return redirect()->route('admin.users.index')->with('success', 'Usuário cadastrado com sucesso.');
    }

    /**
     * Mostra o formulário para editar de um administrador existente.
    */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Atualiza um administrador no banco de dados
    */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'type' => 'required|in:client,admin'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'type' => $validated['type']
        ]);

        Log::info("[UserController][update] - Payload: {json_encode($request->all())}");
        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Mostra o formulário para editar a senha de administrador existente.
    */
    public function editPassword(User $user)
    {
        return view('admin.users.edit.password', compact('user'));
    }

    /**
     * Atualiza a senha um administrador no banco de dados
    */
    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|max:255|confirmed'
        ]);

        $user->update([
            'password' => bcrypt($validated['password'])
        ]);

        Log::info("[UserController][updatePassword] - Payload: " . json_encode($request->all()));
        return redirect()->route('admin.users.edit', $user)->with('success', 'Senha atualizada com sucesso.');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
