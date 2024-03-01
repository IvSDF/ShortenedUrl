<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ShortenUrlController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/shorten', [ShortenUrlController::class, 'store'])->name('shorten.store');
Route::get('/{code}', [ShortenUrlController::class, 'redirect'])->name('shorten.redirect');
