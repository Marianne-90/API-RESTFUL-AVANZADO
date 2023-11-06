<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller): array
    {
        return [
            'identificador' => (int)$seller->id,
            'nombre' => (string)$seller->nombre,
            'correo' => (string)$seller->email,
            'esVerificado' => (string)$seller->verified,
            'fechaDeCreacion' => (string)$seller->created_at,
            'fechaDeActualizacion' => (string)$seller->updated_at,
            'fechaDeEliminacion' => isset($seller->deleted_at) ? $seller->deleted_at : null,
        ];
    }
}
