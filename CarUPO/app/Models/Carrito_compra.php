<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Linea_carrito;

class Carrito_compra extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }

    public function lineas_de_carrito()
    {
        return $this->hasMany(Linea_carrito::class, 'fk_carrito_id');
    }
}
