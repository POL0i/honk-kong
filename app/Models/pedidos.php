<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedidos extends Model
{
    use HasFactory;
    protected $primaryKey='id_pedido';
    protected $fillable=
    [
        'id_pedido',
        'user_id',
        'fecha',
        'total',
        'estado', ['pendiente', 'completado', 'fallido'],
        'direccion_envio',
        'metodo_pago'
    ];

    public function envios()
    {
        return $this->belongsTo(envios::class, 'id_envio');
    }
    public function detalle_pedido()
    {
        return $this->belongsToMany(detalle_pedidos::class, 'id_pedido');
    }
    public function aplicaciones_descuentos()
    {
        return $this->belongsToMany(aplicaciones_descuentos::class, 'id_pedido');
    }
    public function metodos_pagos()
    {
        return $this->hasMany(metodos_pagos::class, 'id_pedido');
    }
    public function users()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
