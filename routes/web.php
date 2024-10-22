<?php

use App\Http\Controllers\Dashboard\ChatController;
use App\Http\Controllers\Dashboard\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RegistrationsController;
use App\Http\Controllers\Dashboard\PropertiesController;
use App\Http\Controllers\Site\CustomAuthController;

use App\Http\Livewire\Index;

//Dashbaord
Route::get('dashboard', Index::class)->name('dashboard');

Route::get('chat', [ChatController::class, 'index'])->name('chat');

Route::get('fetchChat/{userId}', [ChatController::class, 'fetchChat']);

Route::post('sendMessage', [ChatController::class, 'sendMessage']);

Route::get('login', [RegistrationsController::class, 'showLogin']);
Route::POST('loginPerform', [RegistrationsController::class, 'loginPerform'])->name('login.perform');
Route::POST('logout', [RegistrationsController::class, 'logout'])->name('logout');
Route::get('addProperties', [PropertiesController::class, 'addProperties'])->name('addProperties');
Route::get('index', [PropertiesController::class, 'index'])->name('properties.index');
Route::POST('postPoperty', [PropertiesController::class, 'postPoperty'])->name('postPoperty');

// Route::get('index', [CustomAuthController::class, 'dashboard']);
