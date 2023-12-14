<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Log;

class AdminController extends Controller
{
    /**
     * Exibe o painel de controle do administrador
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Mostra o formulário para editar de um administrador existente.
    */
    public function edit(User $user)
    {
        return view('admin.perfil', compact('user'));
    }

    /**
     * Atualiza um administrador no banco de dados
    */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|max:255|email|unique:users'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        Log::info("[AdminController][update] - Payload: {json_encode($request->all())}");
        return redirect()->route('admin.dashboard')->with('success', 'Perfil atualizado com sucesso.');
    }

    /**
     * Mostra o formulário para editar a senha de administrador existente.
    */
    public function editPassword(User $user)
    {
        return view('admin.perfil.edit.password', compact('user'));
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

        Log::info("[AdminController][updatePassword] - Payload: {json_encode($request->all())}");
        return redirect()->route('admin.dashboard')->with('success', 'Senha atualizada com sucesso.');
    }
}
