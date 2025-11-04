<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

$roles = collect(config('roles.products'))->implode('|');

Route::group([
    'prefix' => '/products',
    'middleware' => ['auth:api', "check-roles:{$roles}"]
], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});
