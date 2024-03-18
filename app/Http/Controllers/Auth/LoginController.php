<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Sobrescribe el método authenticated para generar un token Sanctum
    protected function authenticated(Request $request, $user)
    {
        if ($request->wantsJson()) {
            $token = $user->createToken('API Token')->plainTextToken;

            // Puedes devolver el token y/o otros datos de usuario como respuesta
            return response()->json([
                'token' => $token,
                // 'user' => $user // Si también quieres devolver información del usuario
            ]);
        }

        return redirect($this->redirectTo);
    }
}
