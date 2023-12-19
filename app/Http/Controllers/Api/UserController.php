<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('type', UserType::CLIENT->value)->paginate(10);

        return response()->json([
            'currentPage' => $users->currentPage(),
            'data' => $users->items(),
            'perPage' => $users->perPage(),
            'total' => $users->total(),
            'lastPage' => $users->lastPage(),
            'previousPage' => $users->previousPageUrl(),
            'nextPage' => $users->nextPageUrl(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        // Remove a senha do array de atributos
        $userData = $user->toArray();
        unset($userData['password']);

        return response()->json($userData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
