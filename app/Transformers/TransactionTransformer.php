<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction): array
    {
        return [
            'identificador' => (int)$transaction->id,
            'cantidad'=> (int)$transaction->quantity,
            'comprador'=>(int)$transaction->buyer_id,
            'producto'=>(int)$transaction->product_id,
            'fechaDeCreacion' => (string)$transaction->created_at,
            'fechaDeActualizacion' => (string)$transaction->updated_at,
            'fechaDeEliminacion' => isset($transaction->deleted_at) ? $transaction->deleted_at : null,
        ];
    }
}
