<?php

namespace App\Http\Controllers;

use App\Models\Viagem;
use Illuminate\Http\Request;

class ViagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viagens = Viagem::with(['motorista.user', 'passageiro.user'])->get();
        return response()->json($viagens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'latitude_partida' => 'required|numeric|between:-90,90',
            'longitude_partida' => 'required|numeric|between:-180,180',
            'latitude_destino' => 'required|numeric|between:-90,90',
            'longitude_destino' => 'required|numeric|between:-180,180',
            'valor' => 'required|numeric|min:0',
            'data' => 'required|date',
            'motorista_id' => 'required|exists:motoristas,id',
            'passageiro_id' => 'required|exists:passageiros,id',
        ]);

        $viagem = Viagem::create($request->all());
        return response()->json($viagem, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Viagem $viagem)
    {
        return response()->json($viagem->load(['motorista.user', 'passageiro.user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viagem $viagem)
    {
        $request->validate([
            'latitude_partida' => 'sometimes|required|numeric|between:-90,90',
            'longitude_partida' => 'sometimes|required|numeric|between:-180,180',
            'latitude_destino' => 'sometimes|required|numeric|between:-90,90',
            'longitude_destino' => 'sometimes|required|numeric|between:-180,180',
            'valor' => 'sometimes|required|numeric|min:0',
            'data' => 'sometimes|required|date',
            'motorista_id' => 'sometimes|required|exists:motoristas,id',
            'passageiro_id' => 'sometimes|required|exists:passageiros,id',
        ]);

        $viagem->update($request->all());
        return response()->json($viagem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viagem $viagem)
    {
        $viagem->delete();
        return response()->json(null, 204);
    }
}
