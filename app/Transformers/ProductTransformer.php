<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
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
    public function transform(Product $product): array
    {
        return [
            'identificador' => (int)$product->id,
            'titulo' => (string)$product->name,
            'detalle'=> (string)$product->description,
            'disponibles'=> (int)$product->quantity,
            'estado'=>(string)$product->status,
            'imagen'=> url("img/{$product->image}"),
            'vendedor'=>(int)$product->seller_id,
            'fechaDeCreacion' => (string)$product->created_at,
            'fechaDeActualizacion' => (string)$product->updated_at,
            'fechaDeEliminacion' => isset($product->deleted_at) ? $product->deleted_at : null,
        ];
    }
}
