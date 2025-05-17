<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // Mostrar el perfil del usuario autenticado
    public function show()
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        return view('user-profile', compact('user'));
    }

    // Actualizar la información del usuario autenticado
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validación de los datos
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Verificar si hay cambios
        if (
            $data['nombres'] === $user->nombres &&
            $data['apellidos'] === $user->apellidos &&
            $data['email'] === $user->email
        ) {
            return back(); // No se actualiza si no hay cambios
        }

        try {
            $user->update($data);
            return back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el perfil: ' . $e->getMessage()
            ], 500);
        }
    }


    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (password_verify($data['current_password'], $user->password)) {
            $user->update(['password' => bcrypt($data['new_password'])]);
        }

        return back();
    }



}
