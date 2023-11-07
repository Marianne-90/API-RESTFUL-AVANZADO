<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction): array
    {
        return [
            'identificador' => (int)$transaction->id,
            'cantidad' => (int)$transaction->quantity,
            'comprador' => (int)$transaction->buyer_id,
            'producto' => (int)$transaction->product_id,
            'fechaDeCreacion' => (string)$transaction->created_at,
            'fechaDeActualizacion' => (string)$transaction->updated_at,
            'fechaDeEliminacion' => isset($transaction->deleted_at) ? $transaction->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'cantidad' =>  'quantity',
            'comprador' => 'buyer_id',
            'producto' => 'product_id',
            'fechaDeCreacion' => 'created_at',
            'fechaDeActualizacion' => 'updated_at',
            'fechaDeEliminacion' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
