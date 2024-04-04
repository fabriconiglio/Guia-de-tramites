<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Categorie;
use App\Models\Tramite;
use Illuminate\Http\Request;

class TramiteController extends Controller
{
    public function index(Request $request)
    {
        $tramites = Tramite::with('area', 'category')
            ->when($request->search, function ($query) use ($request) {

                $query->where('title', 'like', '%'.$request->search.'%');

                $query->orWhereHas('area', function ($query) use ($request) {
                    $query->where('nombre', 'like', '%'.$request->search.'%'); // Asegúrate de que 'name' es correcto
                });

                $query->orWhereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%'); // Corregido de 'title' a 'name'
                });

            })
            ->orderBy('title', 'asc')
            ->paginate(10);

        return view('tramites.index', compact('tramites'));
    }

    public function create()
    {
        $areas = Area::all();
        $categories = Categorie::all();
        return view('tramites.create', compact('areas', 'categories'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
            'slug' => 'required|string|max:255|unique:tramites',
            'summary' => 'required|string',
            'procedure' => 'nullable|string',
            'requirements' => 'nullable|string',
            'who' => 'nullable|string|max:255',
            'when' => 'nullable|string|max:255',
            'previous' => 'nullable|string|max:255',
            'cost' => 'required|boolean',
            'online' => 'required|boolean',
            'url' => 'nullable|url',
            'time' => 'nullable|string|max:255',
            'more' => 'nullable|string',
            'documentos.*' => 'file|mimes:pdf,jpeg,png|max:2048'
        ]);

        $tramite = Tramite::create($validatedData);

        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $documento) {
                $tramite->addMedia($documento)->toMediaCollection('documentos');
            }
        }

        return redirect()->route('tramites.show', $tramite->id)
            ->with('success', 'Trámite creado con éxito. ¿Desea crear otro?');
    }

    public function show(Tramite $tramite)
    {
        return view('tramites.show', compact('tramite'));
    }

    public function edit(Tramite $tramite)
    {
        $areas = Area::all();
        $categories = Categorie::all();
        return view('tramites.edit', compact('tramite', 'areas', 'categories'));
    }

    public function update(Request $request, Tramite $tramite)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
            'summary' => 'required|string',
            'procedure' => 'nullable|string',
            'requirements' => 'nullable|string',
            'who' => 'nullable|string|max:255',
            'when' => 'nullable|string|max:255',
            'previous' => 'nullable|string|max:255',
            'cost' => 'required|boolean',
            'online' => 'required|boolean',
            'url' => 'nullable|url',
            'time' => 'nullable|string|max:255',
            'more' => 'nullable|string',
            'documentos.*' => 'file|mimes:pdf,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $documento) {
                $tramite->addMedia($documento)
                    ->toMediaCollection('documentos');
            }
        }

        $tramite->update($validatedData);

        return redirect()->route('tramites.show_update', $tramite->id)
            ->with('success', 'Trámite actualizado con éxito.');
    }

    public function destroy(Tramite $tramite)
    {
        $tramite->delete();

        return redirect()->route('tramites.index')
            ->with('success', 'Trámite eliminado con éxito.');
    }

    public function show_update(Tramite $tramite)
    {
        return view('tramites.show_update', compact('tramite'));
    }

    public function destroyMedia(Tramite $tramite, $mediaId)
    {
        $mediaItem = $tramite->media()->findOrFail($mediaId);
        $mediaItem->delete();

        return back()->with('success', 'Documento eliminado con éxito.');
    }
}
