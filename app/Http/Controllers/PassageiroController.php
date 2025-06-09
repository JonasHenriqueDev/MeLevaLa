<?php

namespace App\Http\Controllers;

use App\Models\Passageiro;
use Illuminate\Http\Request;

class PassageiroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passageiros = Passageiro::with('user')->get();
        return response()->json($passageiros);
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

        $passageiro = Passageiro::create($request->all());
        return response()->json($passageiro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Passageiro $passageiro)
    {
        return response()->json($passageiro->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passageiro $passageiro)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'avaliacao' => 'sometimes|required|numeric|min:0|max:5',
        ]);

        $passageiro->update($request->all());
        return response()->json($passageiro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passageiro $passageiro)
    {
        $passageiro->delete();
        return response()->json(null, 204);
    }
}
