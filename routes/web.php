<?php

use App\Http\Controllers\Dashboard\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\CustomAuthController;

use App\Http\Livewire\Index;

//Dashbaord
Route::get('dashboard', Index::class)->name('dashboard');

Route::get('chat', [ChatController::class, 'index'])->name('chat');

Route::get('fetchChat/{userId}', [ChatController::class, 'fetchChat']);

Route::post('sendMessage', [ChatController::class, 'sendMessage']);


// Route::get('index', [CustomAuthController::class, 'dashboard']);
