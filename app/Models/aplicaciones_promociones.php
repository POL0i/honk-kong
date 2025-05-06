<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aplicaciones_promociones extends Model
{
    public $incrementing=false;
    protected $primaryKey= ['id_producto','id_promocion'];
    public $timestamps=false;

    public function promociones()
    {
        return $this->belongsTo(promociones::class, 'id_promocion');
    }
    public function productos()
    {
        return $this->belongsTo(productos::class, 'id_producto');
    }
}
