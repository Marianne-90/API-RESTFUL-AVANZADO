<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/** BUYERS */
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);
/** CATEGORIES */
Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
/** PRODUCTS */
Route::resource('products', ProductController::class)->only(['index', 'show']);
/** TRANSACTIONS */
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
/** SELLERS */
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
/** USERS */
Route::resource('users', UserController::class)->except(['create', 'edit']);
