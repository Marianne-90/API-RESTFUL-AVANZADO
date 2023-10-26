<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $buyers = $product->transactions()
            ->with('buyer') //*añade el objeto transacciones
            ->get()
            ->pluck('buyer') //* extrae objeto transacciones DE CADA PRODUCTO
            ->unique('id')
            ->values();

        return $this->showAll($buyers);
    }
}
