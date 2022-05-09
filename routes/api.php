<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// protected route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::delete('/logout', [UserController::class, 'logout']);
    Route::post('/event/create', [EventController::class, 'create']);

});
// public route
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.sent');
Route::get('/update-password/{token}', function ($token) {
    return $token; //to get the token from the url that has been sent to the user
})->name('password.reset');
Route::post('/update-password', [UserController::class, 'updatePassword'])->name('password.update');
