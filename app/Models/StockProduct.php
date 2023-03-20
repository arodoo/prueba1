<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockProduct extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'stock_products';

    protected $fillable = [
        'producto_id',
        'talla',
        'stock',
    ];
    protected $dates = ['deleted_at'];

    protected function producto(){
        return $this->hasOne('App\Models\Product', 'id', 'producto_id')->withTrashed();
    }
}
