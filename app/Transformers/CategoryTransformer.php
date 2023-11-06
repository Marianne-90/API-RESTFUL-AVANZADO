<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{

    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'identificador' => (int)$category->id,
            'nombre' => (string)$category->name,
            'detalles' => (string)$category->description,
            'fechaDeCreacion' => (string)$category->created_at,
            'fechaDeActualizacion' => (string)$category->updated_at,
            'fechaDeEliminacion' => isset($category->deleted_at) ? $category->deleted_at : null,
        ];
    }
}
