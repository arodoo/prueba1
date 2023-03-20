<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'manufacturers';
    protected $fillable = [
        'nombre',
        'descripcion',
        ];
    protected $dates = ['deleted_at'];

}
