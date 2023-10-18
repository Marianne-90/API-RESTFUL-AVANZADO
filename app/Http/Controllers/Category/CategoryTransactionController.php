<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {

        $transactions = $category
        ->products()
        ->whereHas("transactions") //* productos que tengan al menos una transaccion
        ->with("transactions")
        ->get()
        ->pluck("transactions")
        ->collapse(); //* esto es porque con solo pluck salen muchas colecciones separadas y quieres solo una


        return $this->showAll($transactions);
    }

   
}
