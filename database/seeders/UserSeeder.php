<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário somente motorista
        $user1 = User::create([
            'name' => 'João Motorista',
            'email' => 'joao.motorista@example.com',
            'password' => Hash::make('senha123'),
        ]);
        $user1->motorista()->create([
            'nome' => $user1->name,
            'avaliacao' => 4.8,
        ]);

        // Usuário somente passageiro
        $user2 = User::create([
            'name' => 'Ana Passageira',
            'email' => 'ana.passageira@example.com',
            'password' => Hash::make('senha123'),
        ]);
        $user2->passageiro()->create([
            'nome' => $user2->name,
            'avaliacao' => 4.9,
        ]);

        // Usuário motorista e passageiro
        $user3 = User::create([
            'name' => 'Carlos Motorista e Passageiro',
            'email' => 'carlos.dual@example.com',
            'password' => Hash::make('senha123'),
        ]);
        $user3->motorista()->create([
            'nome' => $user3->name,
            'avaliacao' => 4.7,
        ]);
        $user3->passageiro()->create([
            'nome' => $user3->name,
            'avaliacao' => 4.6,
        ]);
    }
}
