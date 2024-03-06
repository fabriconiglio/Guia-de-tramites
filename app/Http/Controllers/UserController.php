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

        $users = QueryBuilder::for(User::class)
        ->allowedFilters(['name', 'email', 'roles.name']) // Asumiendo que tienes una relación 'roles'
        ->paginate()
        ->appends(request()->query());

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }
}