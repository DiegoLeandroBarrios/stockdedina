<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\AuthError;

class AuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials'));
      

        $this->auth = $factory->createAuth();
    }

    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Crear usuario
    public function register(Request $request)
    {
        try {
            $user = $this->auth->createUserWithEmailAndPassword(
                $request->email,
                $request->password
            );

            return redirect()->route('login')->with('success', 'Usuario creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['register_error' => $e->getMessage()]);
        }
    }

    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Autenticar usuario
    public function login(Request $request)
    {
        try {
            $signInResult = $this->auth->signInWithEmailAndPassword(
                $request->email,
                $request->password
            );

            session(['firebase_user' => $signInResult->firebaseUserId(),
                    'firebase_user_email' => $signInResult->data()['email'],]);
            
            

            return redirect()->route('home')->with('success', 'Se incio sesión correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['login_error' => 'Credenciales incorrectas']);
        }
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('firebase_user');
        return redirect()->route('login');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }


    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        try {
            $this->auth->sendPasswordResetLink($request->email);
    
            return redirect()->route('login')->with('success', 'Se ha enviado un email para restablecer tu contraseña.');
        } catch (AuthError $e) {
            return redirect()->back()->withErrors(['reset_error' => 'No se pudo enviar el email. Verifica tu dirección.']);
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['reset_error' => 'Ocurrió un error inesperado.']);
        }
    }
    

}
