<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";
    protected $primaryKey = "id";
    protected $fillable = [
        'categoria_id',
        'fabricante_id',
        'nombre',
        'descripcion',
        'precio_u',
        'precio_m',
        'cantidad_m',
        'QR',
        'img',
    ];
    protected $date = ['deleted_at'];

    public function categoria()
    {
        return $this->hasOne('App\Models\Category', 'id', 'categoria_id')->withTrashed();
    }

    public function fabricante()
    {
        return $this->hasOne('App\Models\Manufacturer', 'id', 'fabricante_id')->withTrashed();
    }
}
