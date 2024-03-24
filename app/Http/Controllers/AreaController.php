<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Exception;

class AreaController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Area::whereNull('area_id');

        if ($search) {
            $query->where(function($q) use ($search) {
                // Primero, busca coincidencias en las áreas padre
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('direccion', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('children', function($q) use ($search) {
                // Luego, busca coincidencias en las áreas hijos
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('direccion', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $areas = $query->with('children')->paginate(10);

        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        $areas = Area::whereNull('area_id')->get();
        return view('areas.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'area_id' => 'nullable|exists:areas,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
        ]);

        Area::create($validatedData);

        return redirect()->route('areas.index')->with('success', 'Área creada con éxito.');
    }

    public function edit(Area $area)
    {
        $areas = Area::whereNull('area_id')->get();

        return view('areas.create', compact('area', 'areas'));
    }

    public function update(Request $request, Area $area)
    {
        $validatedData = $request->validate([
            'area_id' => 'nullable|exists:areas,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
        ]);

        $area->update($validatedData);

        return redirect()->route('areas.index')->with('success', 'Área actualizada con éxito.');
    }

    public function destroy(Area $area)
    {
        try {
            // Verificar si el área tiene subáreas o dependencias
            if ($area->children()->exists()) {
                // Prohibir eliminación y enviar mensaje de error
                return back()->withErrors('Esta área tiene subáreas dependientes y no puede ser eliminada.');
            }

            // Si no hay dependencias, eliminar el área
            $area->delete();

            return redirect()->route('areas.index')->with('success', 'Área eliminada con éxito.');

        } catch (Exception $e) {
            // En caso de error, enviar mensaje de error
            return back()->withErrors('Ocurrió un error al intentar eliminar el área.');
        }
    }

}
