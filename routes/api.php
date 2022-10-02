<?php

use App\Http\Controllers\Income\IncomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', static function () {
    return response()->json(['success' => true]);
});

Route::resource('/incomes', IncomeController::class)->names('incomes');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
