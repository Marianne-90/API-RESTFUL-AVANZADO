<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $sellers = $category
        ->products()
        ->with("seller")
        ->get()
        ->pluck("seller") //* extrae el objeto seller de la lista de product
        ->unique() 
        ->values(); //* quedan valores vacíos entonces esto los quita

        return $this->showAll($sellers);
    }

    
}
