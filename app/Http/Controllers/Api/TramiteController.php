<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Inicia la consulta con una relación para incluir la información relacionada
        $query = Tramite::with(['area', 'category']);

        // Filtro por término de búsqueda
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%")
                    ->orWhere('summary', 'LIKE', "%{$search}%")
                    ->orWhere('procedure', 'LIKE', "%{$search}%");
            });
        }

        // Filtro por área
        if ($request->has('area')) {
            $slug = $request->area;
            $areaIds = Area::where('slug', $slug)->orWhereHas('parent', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->pluck('id')->toArray();

            $query->whereIn('area_id', $areaIds);
        }

        // Filtro por categoría
        if ($request->has('category')) {
            $slug = $request->category;
            $query->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
        }

        // Añade la URL de cada medio asociado al trámite
        $query->with('media');


        // Obtener los trámites y devolver en formato JSON
        $tramites = $query->get();

        return response()->json($tramites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string  $identifier
     * @return \Illuminate\Http\Response
     */
    public function show($identifier)
    {
        // Intenta encontrar el trámite por slug o por ID
        $tramite = Tramite::where(function ($query) use ($identifier) {
            $query->where('slug', $identifier)
                ->orWhere('id', $identifier);
        })
            ->with(['area', 'category', 'media'])
            ->first();

        if (!$tramite) {
            return response()->json(['error' => 'Trámite no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Añade la URL de cada medio asociado al trámite
        $tramite->media = $tramite->getMedia('documentos')->map(function ($media) {
            return ['url' => $media->getUrl(), 'name' => $media->name];
        });

        return response()->json($tramite);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
