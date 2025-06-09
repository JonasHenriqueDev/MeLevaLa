<?php

namespace Database\Seeders;

use App\Models\Motorista;
use App\Models\Passageiro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motoristas = Motorista::all();
        $passageiros = Passageiro::all();

        foreach ($motoristas as $motorista) {
            foreach ($passageiros as $passageiro) {
                $motorista->viagens()->create([
                    'latitude_partida' => rand(-90, 90),
                    'longitude_partida' => rand(-180, 180),
                    'latitude_destino' => rand(-90, 90),
                    'longitude_destino' => rand(-180, 180),
                    'valor' => rand(10, 100),
                    'data' => now(),
                    'passageiro_id' => $passageiro->id,
                ]);
            }
        }
    }
}
