<?php

use App\Http\Controllers\Dashboard\ChatController;
use App\Http\Controllers\Dashboard\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RegistrationsController;
use App\Http\Controllers\Dashboard\PropertiesController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProvidersController;
use App\Http\Controllers\Site\CustomAuthController;

use App\Http\Livewire\Index;

//Dashbaord
Route::get('dashboard', Index::class)->name('dashboard');

Route::get('chat', [ChatController::class, 'index'])->name('chat');

Route::get('fetchChat/{userId}', [ChatController::class, 'fetchChat']);

Route::post('sendMessage', [ChatController::class, 'sendMessage']);

Route::get('login', [RegistrationsController::class, 'showLogin']);
Route::post('loginPerform', [RegistrationsController::class, 'loginPerform'])->name('login.perform');
Route::post('logout', [RegistrationsController::class, 'logout'])->name('logout');


Route::get('properties', [PropertiesController::class, 'index'])->name('properties.index');
Route::get('properties/add', [PropertiesController::class, 'add'])->name('properties.add');
Route::post('properties/store', [PropertiesController::class, 'store'])->name('properties.store');
Route::get('properties/show/{id}', [PropertiesController::class, 'show'])->name('properties.show');
Route::post('properties/update', [PropertiesController::class, 'update'])->name('properties.update');
Route::DELETE('properties/destroy/{id}', [PropertiesController::class, 'destroy'])->name('properties.destroy');
// Route::get('properties/delete/{id}', [PropertiesController::class, 'destroy'])->name('organization.destroy');
Route::resource('clients', ClientController::class);
Route::resource('providers', ProvidersController::class);


// Route::get('index', [CustomAuthController::class, 'dashboard']);
