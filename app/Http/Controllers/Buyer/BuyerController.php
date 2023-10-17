<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compradores = Buyer::has('transactions')->get();
        return response()->json(['data' => $compradores, 200]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $compradores = Buyer::has('transactions')->findOrFail($id);
        return response()->json(['data' => $compradores, 200]);
    }
}
