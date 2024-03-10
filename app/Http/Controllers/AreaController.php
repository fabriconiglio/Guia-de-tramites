<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    
    public function index(Request $request)
    {
        // Iniciar la consulta para obtener todas las áreas
        $query = Area::with('parent');

        // Aplicar filtro de búsqueda si 'search' es parte de la solicitud
        if ($search = $request->input('search')) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('direccion', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereHas('parent', function($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                });
        }

        $areas = $query->paginate();
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
    
}
