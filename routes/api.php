<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CampaignController;

Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']);        
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');  

Route::middleware('auth:sanctum')->group(function () {  
    
    // Abonnés
    Route::post('/subscribers', [SubscriberController::class, 'store']);
    Route::get('/subscribers', [SubscriberController::class, 'index']);
    Route::get('/subscribers/{id}', [SubscriberController::class, 'show']);
    Route::put('/subscribers/{id}', [SubscriberController::class, 'update']);
    Route::delete('/subscribers/{id}', [SubscriberController::class, 'destroy']);
    
    // Newsletters
    Route::post('/newsletters', [NewsletterController::class, 'store']);
    Route::get('/newsletters', [NewsletterController::class, 'index']);
    Route::get('/newsletters/{id}', [NewsletterController::class, 'show']);
    Route::put('/newsletters/{id}', [NewsletterController::class, 'update']);
    Route::delete('/newsletters/{id}', [NewsletterController::class, 'destroy']);
    
    // Campagnes
    Route::post('/campaigns', [CampaignController::class, 'store']);
    Route::get('/campaigns', [CampaignController::class, 'index']);
    Route::get('/campaigns/{id}', [CampaignController::class, 'show']);
    Route::put('/campaigns/{id}', [CampaignController::class, 'update']);
    Route::delete('/campaigns/{id}', [CampaignController::class, 'destroy']);
});
