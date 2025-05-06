<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resenas extends Model
{
    use HasFactory;
    protected $primaryKey='id_reseña';
    protected $fillable=
    [
        'comentario',
        'calificacion',
        'fecha',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
