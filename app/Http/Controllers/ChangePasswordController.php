<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no coincide']);
        }

        $user->password = Hash::make($request->new_password);
        $user->must_change_password = false; // Asegúrate de actualizar este campo
        $user->save();

        return redirect()->route('home')->with('success', 'Contraseña cambiada exitosamente');
    }

}
