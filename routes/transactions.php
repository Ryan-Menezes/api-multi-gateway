<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

$roles = collect(config('roles.transactions'))->implode('|');
$rolesRefound = collect(config('roles.transactions-refund'))->implode('|');

Route::group([
    'prefix' => '/transactions',
    'middleware' => ['auth:api']
], function () use ($roles, $rolesRefound) {
    Route::group(['middleware' => ["roles:{$roles}"]], function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::get('/{id}', [TransactionController::class, 'show']);
    });

    Route::group(['middleware' => ["roles:{$rolesRefound}"]], function () {
        Route::post('/{id}/refund', [TransactionController::class, 'refund']);
    });
});
