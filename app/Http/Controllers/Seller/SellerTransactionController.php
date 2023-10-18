<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Seller $seller)
    {
        $transactions = $seller
            ->products()
            ->whereHas('transactions') //*productos que tienen transacciones
            ->with('transactions')//*añade el objeto transacciones
            ->get()
            ->pluck('transactions') //* extrae objeto transacciones DE CADA PRODUCTO
            ->collapse(); //* Une todas las listas 

        return $this->showAll($transactions);
    }
}
