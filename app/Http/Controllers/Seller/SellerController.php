<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vendedores = Seller::has('products')->get();
        return response()->json(['data' => $vendedores, 200]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendedores = Seller::has('products')->findOrFail($id);
        return response()->json(['data' => $vendedores, 200]);
    }
}
