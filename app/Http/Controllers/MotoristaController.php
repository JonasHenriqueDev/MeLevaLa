<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motoristas = Motorista::with('user')->get();
        return response()->json($motoristas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'avaliacao' => 'required|numeric|min:0|max:5',
        ]);

        $motorista = Motorista::create($request->all());
        return response()->json($motorista, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Motorista $motorista)
    {
        return response()->json($motorista->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motorista $motorista)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'avaliacao' => 'sometimes|required|numeric|min:0|max:5',
        ]);

        $motorista->update($request->all());
        return response()->json($motorista);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motorista $motorista)
    {
        $motorista->delete();
        return response()->json(null, 204);
    }
}
