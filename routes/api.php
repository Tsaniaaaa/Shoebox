<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('shoes', ShoeController::class)->except([
    'create','edit'
]);

Route::resource('categories', CategoryController::class)->except([
    'create','edit'
]);

Route::resource('transactions', TransactionController::class)->except([
    'create','edit','update', 'destroy'
]);

Route::resource('vouchers', VoucherController::class)->except([
    'create','edit'
]);

//proctected routes
Route::middleware('auth:sanctum')->group(function() {
    Route::resource('shoes', ShoeController::class)->except('create', 'edit', 'show', 'index');
    Route::post('/logout', [AuthController::class, 'logout']);
});