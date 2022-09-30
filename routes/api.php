<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'string_manipulation'], function() {
        Route::get('sorted_string/{word}', [ApiController::class, 'sortString']);

        Route::get('break_number/{number}', [ApiController::class, 'breakNumber']);
        
        Route::get('number_to_binary/{sentence}', [ApiController::class, 'numberToBinary']);
        
        Route::get('prefix/{exp}', [ApiController::class, 'prefixOutput']);
    });
});