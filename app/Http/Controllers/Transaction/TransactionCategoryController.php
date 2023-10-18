<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Transaction $transaction)
    {
        //*? conociendo la transacción vamos a acceder a las categorías pero 
        //*? pero sabemos que una transacción tiene un porducto y que ese producto tiene categorías

        $categories = $transaction->product->categories;
        return $this->showAll($categories);
    }


}
