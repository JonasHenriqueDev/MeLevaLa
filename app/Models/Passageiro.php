<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passageiro extends Model
{
    protected $fillable = ['nome', 'avaliacao'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function viagens()
    {
        return $this->hasMany(Viagem::class);
    }
}
