<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('viagems', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude_partida', 10, 7);
            $table->decimal('longitude_partida', 10, 7);
            $table->decimal('latitude_destino', 10, 7);
            $table->decimal('longitude_destino', 10, 7);
            $table->float('valor');
            $table->date('data');
            $table->foreignId('passageiro_id')->constrained('passageiros')->onDelete('cascade');
            $table->foreignId('motorista_id')->constrained('motoristas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viagems');
    }
};
