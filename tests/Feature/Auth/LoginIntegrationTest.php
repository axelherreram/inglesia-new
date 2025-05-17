<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba de integración para el flujo de inicio de sesión exitoso.
     */
    public function test_user_can_login_and_access_dashboard()
    {
        // Crear un usuario de prueba en la base de datos
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'), // Se utiliza Hash para asegurar que la contraseña esté encriptada
        ]);

        // Simular una solicitud POST a la ruta de inicio de sesión
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ]);

        // Verificar que la redirección sea correcta (al dashboard en este caso)
        $response->assertRedirect('/dashboard');
        
        // Verificar que el usuario esté autenticado después de iniciar sesión
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Prueba de integración para el flujo de inicio de sesión fallido.
     */
    public function test_user_cannot_login_with_wrong_password()
    {
        // Crear un usuario de prueba en la base de datos
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'), // Contraseña correcta
        ]);

        // Intentar iniciar sesión con una contraseña incorrecta
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',
        ]);

        // Verificar que el usuario no haya sido autenticado
        $this->assertGuest();

        // Verificar que redirija de vuelta al formulario de inicio de sesión
        $response->assertRedirect('/');
        
        // Verificar que se muestre un mensaje de error de credenciales incorrectas
        $response->assertSessionHas('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
    }

    /**
     * Prueba de integración para verificar que el usuario pueda cerrar sesión.
     */
    public function test_user_can_logout()
    {
        // Crear y autenticar un usuario
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($user);

        // Simular la solicitud de cierre de sesión
        $response = $this->post('/logout');

        // Verificar que el usuario ya no esté autenticado
        $this->assertGuest();

        // Verificar la redirección a la página de inicio o login después del logout
        $response->assertRedirect('/');
    }
}
