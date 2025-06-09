<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar todos usuários com motorista e passageiro carregados
    public function index()
    {
        $users = User::with(['motorista', 'passageiro'])->get();
        return response()->json($users);
    }

    // Criar usuário novo
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'is_motorista' => 'sometimes|boolean',
            'is_passageiro' => 'sometimes|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->boolean('is_motorista')) {
            $user->motorista()->create([
                'nome' => $user->name,
                'avaliacao' => 0,
            ]);
        }

        if ($request->boolean('is_passageiro')) {
            $user->passageiro()->create([
                'nome' => $user->name,
                'avaliacao' => 0,
            ]);
        }

        return response()->json($user->load('motorista', 'passageiro'), 201);
    }

    // Mostrar um usuário específico pelo ID
    public function show(User $user)
    {
        return response()->json($user->load('motorista', 'passageiro'));
    }

    // Atualizar dados do usuário e se quiser, motorista/passageiro (simples)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed',
            'is_motorista' => 'sometimes|boolean',
            'is_passageiro' => 'sometimes|boolean',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Criar ou deletar motorista conforme flag
        if ($request->has('is_motorista')) {
            if ($request->boolean('is_motorista')) {
                if (!$user->motorista) {
                    $user->motorista()->create([
                        'nome' => $user->name,
                        'avaliacao' => 0,
                    ]);
                }
            } else {
                $user->motorista?->delete();
            }
        }

        // Criar ou deletar passageiro conforme flag
        if ($request->has('is_passageiro')) {
            if ($request->boolean('is_passageiro')) {
                if (!$user->passageiro) {
                    $user->passageiro()->create([
                        'nome' => $user->name,
                        'avaliacao' => 0,
                    ]);
                }
            } else {
                $user->passageiro?->delete();
            }
        }

        return response()->json($user->load('motorista', 'passageiro'));
    }

    // Deletar usuário e cascata em motorista/passageiro
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
