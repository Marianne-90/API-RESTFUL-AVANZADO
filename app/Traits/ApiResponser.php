<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Fractal\Fractal;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {

        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], 200);
        }
        $tranformer = $collection->first()->transformer;

        $collection = $this -> sortData($collection);
        $collection = $this->transformData($collection, $tranformer);
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {

        $tranformer = $instance->transformer;
        $instance = $this->transformData($instance, $tranformer);

        return $this->successResponse($instance, $code);
    }

    protected function showMessage(string $text, $code = 200)
    {
        return $this->successResponse(['data' => $text], $code);
    }

    protected function sortData(Collection $collection){

        if(request()->has('sort_by')){
            $attribute = request()->sort_by;
            $collection = $collection->sortBy->{$attribute};
        }

        return $collection;
    }

    /**
     * Summary of transformData
     * @param mixed $data
     * @param mixed $transformer
     * @return array|null
     */
    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }
}
