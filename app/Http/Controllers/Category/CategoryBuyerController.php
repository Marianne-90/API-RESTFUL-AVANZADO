<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $buyers = $category
        ->products()
        ->whereHas("transactions") //* productos que tengan al menos una transaccion
        ->with("transactions.buyer")
        ->get()
        ->pluck("transactions") //* esto es porque con solo pluck salen muchas colecciones separadas y quieres solo una
        ->collapse()
        ->pluck('buyer') //*ahora para obtener los compradores
        ->unique()
        ->values();


        return $this->showAll($buyers);
    }

  
}
