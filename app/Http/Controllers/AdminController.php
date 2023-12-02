<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Exibe o painel de controle do administrador
    */
    public function index()
    {
        return view('admin.dashboard');
    }
    
    // Gestão de Usuários e Gestão de relatórios
}