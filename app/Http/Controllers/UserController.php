<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\QueryBuilder;


class UserController extends Controller
{
    public function index(Request $request)
    {

        if (!auth()->user()->hasRole('Usuario Administrador del Sistema')) {
            // Redirige al usuario a donde consideres adecuado
            return redirect()->route('home');
        }

        // Iniciar la consulta de todos los usuarios
        $query = User::query();

        // Comprobar si se envió un término de búsqueda
        if ($search = $request->input('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhereHas('roles', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Paginar los resultados
        $users = $query->paginate()->appends(request()->query());

        return view('users.index', compact('users'));
        
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}