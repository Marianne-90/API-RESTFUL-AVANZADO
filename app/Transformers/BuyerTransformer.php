<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer): array
    {
        return [
            'identificador' => (int)$buyer->id,
            'nombre' => (string)$buyer->nombre,
            'correo' => (string)$buyer->email,
            'esVerificado' => (string)$buyer->verified,
            'fechaDeCreacion' => (string)$buyer->created_at,
            'fechaDeActualizacion' => (string)$buyer->updated_at,
            'fechaDeEliminacion' => isset($buyer->deleted_at) ? $buyer->deleted_at : null,
        ];
    }
}
