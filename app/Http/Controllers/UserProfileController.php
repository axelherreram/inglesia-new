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
        $user = auth()->user(); // Obtener el usuario autenticado
 
        // Validación de los datos enviados por el formulario
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Contraseña opcional con un mínimo de 8 caracteres
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.', // Mensaje de error personalizado
        ]);

        // Verificar si se ha cambiado algo
        $changes = false;

        // Comparar los campos de texto
        if ($data['nombres'] !== $user->nombres || $data['apellidos'] !== $user->apellidos || $data['email'] !== $user->email) {
            $changes = true;
        }

        // Verificar si se ha enviado una nueva contraseña
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
            $changes = true; // Si cambia la contraseña, marcar como un cambio
        } else {
            unset($data['password']); // No actualizar la contraseña si no se envía
        }

        // Si no hay cambios, redirigir sin guardar
        if (!$changes) {
            return redirect()->route('user.profile')->with('info', 'No se realizaron cambios.');
        }

        // Actualizar la información del usuario si hay cambios
        $user->update($data);

        // Redirigir de nuevo al perfil con un mensaje de éxito
        return redirect()->route('user.profile')->with('success', 'Perfil actualizado con éxito.');
    }
}
