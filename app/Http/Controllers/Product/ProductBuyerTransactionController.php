<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product, User $buyer)
    {

        $rules = [
            'quantity' => 'required|integer|min:1',
        ];

        $request->validate($rules);

        if ($buyer->id == $product->seller->id) {
            return $this->errorResponse('El comprador debe ser distinto al vendedor', 500);
        }

        if (!$buyer->esVerificado()) {
            return $this->errorResponse('El comprador debe ser verificado', 409);
        }

        if (!$product->seller->esVerificado()) {
            return $this->errorResponse('El vendedor debe ser verificado', 409);
        }

        if (!$product->estaDisponible()) {
            return $this->errorResponse('Producto no disponible', 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('El producto no tiene el inventario requerido', 409);
        }


        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);


            return $this->showOne($transaction, 201);
        });
    }
}
