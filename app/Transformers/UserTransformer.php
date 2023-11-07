<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'identificador' => (int)$user->id,
            'nombre' => (string)$user->name,
            'correo' => (string)$user->email,
            'esVerificado' => (string)$user->verified,
            'esAdministrador' => ($user->admin == 'true'),
            'fechaDeCreacion' => (string)$user->created_at,
            'fechaDeActualizacion' => (string)$user->updated_at,
            'fechaDeEliminacion' => isset($user->deleted_at) ? $user->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'email',
            'esVerificado' => 'verified',
            'esAdministrador' => 'admin',
            'fechaDeCreacion' => 'created_at',
            'fechaDeActualizacion' => 'updated_at',
            'fechaDeEliminacion' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
