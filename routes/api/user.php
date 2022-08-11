<?php

use App\User\Http\Controllers\GetSpecialistController;
use App\User\Http\Controllers\GetUserLegacyDeclarationController;
use App\User\Http\Controllers\GetUserUnauthenticatedController;
use App\User\Http\Controllers\PostPasswordChangeController;
use App\User\Http\Controllers\PostPasswordRecoverController;
use App\User\Http\Controllers\PostSpecialistInviteController;
use App\User\Http\Controllers\PostUserAddressController;
use App\User\Http\Controllers\PostUserController;
use App\User\Http\Controllers\PostSpecialistController;
use App\User\Http\Controllers\PutUserController;
use App\User\Http\Controllers\PutSpecialistAddressController;
use App\User\Http\Controllers\PutSpecialistController;
use App\User\Http\Controllers\PutSpecialistEmailController;
use App\User\Http\Controllers\PutSpecialistPhoneController;
use App\User\Http\Controllers\PutSpecialistSkillController;
use App\User\Http\Controllers\PutUserUnauthenticatedController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['unauthenticated']], static function () {
    Route::get('{userId}', [GetUserUnauthenticatedController::class, 'handle']);
    Route::post('/', [PostUserController::class, 'handle']);
    Route::put('complete/{userId}', [PutUserUnauthenticatedController::class, 'handle']);
    Route::post('address', [PostUserAddressController::class, 'handle']);
    Route::post('password-recover', [PostPasswordRecoverController::class, 'handle']);
    Route::post('password-change/{hash}', [PostPasswordChangeController::class, 'handle']);

    Route::group(['prefix' => 'specialist'], static function () {
        Route::post('/', [PostSpecialistController::class, 'handle']);
    });
});

Route::group(['middleware' => ['apiJwt']], static function () {

    Route::put('{userId}', [PutUserController::class, 'handle']);

    Route::group(['prefix' => 'legacy-declaration'], static function () {
        Route::get('{legacyDeclarationId}', [GetUserLegacyDeclarationController::class, 'handle']);
    });

    Route::group(['prefix' => 'specialist'], static function () {
        Route::get('{specialistId}', [GetSpecialistController::class, 'handle']);
        Route::put('{specialistId}', [PutSpecialistController::class, 'handle']);
        Route::put('{specialistId}/addresses', [PutSpecialistAddressController::class, 'handle']);
        Route::put('{specialistId}/emails', [PutSpecialistEmailController::class, 'handle']);
        Route::put('{specialistId}/phones', [PutSpecialistPhoneController::class, 'handle']);
        Route::put('{specialistId}/skills', [PutSpecialistSkillController::class, 'handle']);
        Route::post('invite', [PostSpecialistInviteController::class, 'handle']);
    });
});
