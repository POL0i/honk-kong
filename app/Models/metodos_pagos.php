<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodos_pagos extends Model
{
    use HasFactory;
    protected $primaryKey='id_pago';
    protected $fillable=
    [
        'nombre_titular',
        'numero_targera',
        'fecha_expiracion',
        'cvv',
        'monto',
        'estado', ['pendiente','aprobado','fallido','reembolsado'],
        'user_id',
        'id_pedido'
    
    ];

    public function pedidos()
    {
        return $this->belongsTo(pedidos::class, 'id_pedido');
    }
    public function users()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
