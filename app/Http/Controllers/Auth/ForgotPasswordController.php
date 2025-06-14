<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use App\Models\User;
class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Verifica si el correo existe en la base de datos
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'El correo no está registrado en nuestro sistema.']);
        }

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('login')->with('status', 'Correo de restablecimiento enviado. Revisa tu correo.');
        } else {
            return back()->withErrors(['email' => 'No se pudo enviar el correo. Inténtalo nuevamente.']);
        }
    }


    public function showLinkRequestForm()
    {
        return view('forgot-password');
    }
}
