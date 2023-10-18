<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compradores = Buyer::has('transactions')->get();
        return $this->showAll($compradores);
    }


    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {   //*! debemos hacer una inyección implícita para que esto tenga el mismo resultado que 
        //*! si aplicáramos el código comentado, revizar carpeta scopes

        // $comprador = Buyer::has('transactions')->findOrFail($id);
        return $this->showOne($buyer, 200);
    }
}
