<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    protected $primatyKey='id_producto';
    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'imagen_url',
        'descuento'
    ];

    public function categorias()    
    {
        return $this->belongsTo(categorias::class, 'id_categoria');
    }
    public function aplicaciones_promociones()
    {
        return $this->belongsToMany(aplicaciones_promociones::class, 'id_producto');
    }
    public function detalle_pedidos()
    {
        return $this->belongsToMany(detalle_pedidos::class, 'id_producto');
    }
}
