<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{

    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer): array
    {
        return [
            'identificador' => (int)$buyer->id,
            'nombre' => (string)$buyer->name,
            'correo' => (string)$buyer->email,
            'esVerificado' => (string)$buyer->verified,
            'fechaDeCreacion' => (string)$buyer->created_at,
            'fechaDeActualizacion' => (string)$buyer->updated_at,
            'fechaDeEliminacion' => isset($buyer->deleted_at) ? $buyer->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'email',
            'esVerificado' => 'verified',
            'fechaDeCreacion' => 'created_at',
            'fechaDeActualizacion' => 'updated_at',
            'fechaDeEliminacion' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
