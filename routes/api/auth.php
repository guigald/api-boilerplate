<?php

use App\Auth\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['unauthenticated']], static function () {
    Route::post('/', [LoginController::class, 'handler']);
});

Route::group(['middleware' => ['apiJwt']], static function () {
    //
});
