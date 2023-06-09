<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carrito_compra;
use App\Models\Producto;

class Linea_carrito extends Model
{
    use HasFactory;

    public function carritoCompra()
    {
        return $this->belongsTo(Carrito_Compra::class, 'fk_carrito_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'fk_producto_id');
    }
}
