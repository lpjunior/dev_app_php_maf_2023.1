<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
    // Gestão de relatórios
}