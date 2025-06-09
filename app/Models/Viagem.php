<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Viagem extends Model
{
    protected $fillable = [
        'latitude_partida',
        'longitude_partida',
        'latitude_destino',
        'longitude_destino',
        'valor',
        'data',
        'motorista_id',
        'passageiro_id',
    ];

    public function motorista(): BelongsTo
    {
        return $this->belongsTo(Motorista::class);
    }

    public function passageiro(): BelongsTo
    {
        return $this->belongsTo(Passageiro::class);
    }

//    public function users(): BelongsToMany
//    {
//        return $this->belongsToMany(User::class, 'viagem_user', 'viagem_id', 'user_id');
//    }
}
