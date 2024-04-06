<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        //
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
