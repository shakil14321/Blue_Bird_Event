<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\CartItemController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\NotificationController;



// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('carts', CartController::class);
Route::apiResource('cart-items', CartItemController::class);
Route::apiResource('subcategories', SubCategoryController::class);
Route::apiResource('favorites', FavoriteController::class);
Route::apiResource('media', MediaController::class);
Route::apiResource('notifications', NotificationController::class);

Route::prefix('conversations')->group(function () {
    Route::post('/', [ConversationController::class, 'store']); // start conversation
    Route::get('/', [ConversationController::class, 'index']); // list
    Route::get('/{id}', [ConversationController::class, 'show']); // single

    // Messages inside conversation
    Route::post('/{id}/messages', [MessageController::class, 'store']);
    Route::get('/{id}/messages', [MessageController::class, 'index']);
});


// Protected routes (need Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/profile', [AuthController::class, 'profile']);

    // User CRUD
    Route::apiResource('users', UserController::class);
});
