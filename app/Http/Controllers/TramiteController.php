<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use Illuminate\Http\Request;

class TramiteController extends Controller
{
    public function index(Request $request)
    {
        $tramites = Tramite::with('area')
        ->when($request->search, function ($query) use ($request) {
            return $query->where('titulo', 'like', '%'.$request->search.'%')
                ->orWhere('categoria', 'like', '%'.$request->search.'%');
        })
            ->orderBy('titulo', 'asc')
            ->paginate(10);

        return view('tramites.index', compact('tramites'));
    }
}
