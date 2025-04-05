<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba de login exitoso.
     *
     * @return void
     */
    public function test_user_can_login_with_correct_credentials()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Simular la solicitud de inicio de sesión
        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        // Verificar que el usuario fue redirigido al dashboard
        $response->assertRedirect('dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Prueba de login con credenciales incorrectas.
     *
     * @return void
     */
    public function test_user_cannot_login_with_incorrect_credentials()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Intentar iniciar sesión con una contraseña incorrecta
        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'wrongpassword',
        ]);

        // Verificar que no se haya autenticado y que redirija de vuelta con error
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
        $this->assertGuest();
    }
}
