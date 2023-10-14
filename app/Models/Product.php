<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRODUCTO_DISPONIBLE = 'disponible';
    const PRODUCTO_NO_DISPONIBLE = 'no disponible';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    public function estaDisponible()
    {
        return $this->status == Product::PRODUCTO_DISPONIBLE;
    }


    //* puede tener muchas categorías
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //* posee muchas transacciones (está presente en muchas transacciones) 
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    //* tiene un vendedor

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
