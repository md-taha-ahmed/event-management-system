<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventInvitationController;
use App\Http\Controllers\Controller;

// protected route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::delete('/logout', [UserController::class, 'logout']);
    Route::post('/event/create', [EventController::class, 'create']);
    Route::post('/event/update', [EventController::class, 'update']);
    Route::get('/event/list/created', [EventController::class, 'show']);
    Route::post('/event/invite', [EventInvitationController::class, 'create']);
    Route::get('/event/list/invited', [EventInvitationController::class, 'show']);
    Route::post('/event/search', [Controller::class, 'showEvent']);
});
// public route
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.sent');
Route::get('/update-password/{token}', function ($token) {
    return $token; //to get the token from the url that has been sent to the user
})->name('password.reset');
Route::post('/update-password', [UserController::class, 'updatePassword'])->name('password.update');
