<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::post('/chat', [ChatController::class, 'startChat']);
// Route::post('/chat/{chatId}/message', [ChatController::class, 'sendMessage']);
// Route::get('/chat/{chatId}/messages', [ChatController::class, 'getMessages']);


// User routes
Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users/logout', [UserController::class, 'logout']);
    Route::get('/users/profile', [UserController::class, 'show']);
    Route::put('/users/profile', [UserController::class, 'update']);
    Route::delete('/users/profile', [UserController::class, 'destroy']);



    //Category routes
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::get('/categories', [CategoryController::class, 'index']);

    // SubCategory routes
    Route::post('/subcategories', [SubCategoryController::class, 'store']);
    Route::get('/subcategories/{id}', [SubCategoryController::class, 'show']);
    Route::put('/subcategories/{id}', [SubCategoryController::class, 'update']);
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy']);
    Route::get('/subcategories', [SubCategoryController::class, 'index']);
    Route::get('/subcategories/{id}/services', [SubCategoryController::class, 'services']);

    // ServiceRequest routes
    Route::post('/service-requests', [ServiceRequestController::class, 'store']);
    Route::get('/service-requests/{id}', [ServiceRequestController::class, 'show']);
    Route::put('/service-requests/{id}', [ServiceRequestController::class, 'update']);
    Route::delete('/service-requests/{id}', [ServiceRequestController::class, 'destroy']);
    Route::get('/service-requests', [ServiceRequestController::class, 'index']);
    Route::put('/service-requests/{id}/status', [ServiceRequestController::class, 'updateStatus']);

    // Service routes
    Route::post('/services', [ServiceController::class, 'store']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/search', [ServiceController::class, 'search']);

    // Notification routes
    Route::post('/notifications', [NotificationController::class, 'store']);
    Route::get('/notifications/{id}', [NotificationController::class, 'show']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::put('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);
    
    //Chat route
    Route::post('/chat', [ChatController::class, 'startChat']);
    Route::post('/chat/{chatId}/message', [ChatController::class, 'sendMessage']);
    Route::get('/chat/{chatId}/messages', [ChatController::class, 'getMessages']);
    Route::delete('/chat/{messageId}', [ChatController::class, 'deleteMessage']);
   
});

// Service Provider routes
Route::post('/providers/register', [ServiceProviderController::class, 'register']);
Route::post('/providers/login', [ServiceProviderController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/providers/logout', [ServiceProviderController::class, 'logout']);
    Route::get('/providers/profile', [ServiceProviderController::class, 'show']);
    Route::put('/providers/profile', [ServiceProviderController::class, 'update']);
    Route::delete('/providers/profile', [ServiceProviderController::class, 'destroy']);
});

