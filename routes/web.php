<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ChatController;
use App\Http\Controllers\Dashboard\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RegistrationsController;
use App\Http\Controllers\Dashboard\PropertiesController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProvidersController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\MenusController;
use App\Http\Controllers\Dashboard\permissionsController;

use App\Http\Controllers\Site\CustomAuthController;

use App\Http\Livewire\Index;

//Dashbaord

require __DIR__ . '/frontend.php';

Route::get('login', [RegistrationsController::class, 'showLogin'])->name('login');
Route::post('loginPerform', [RegistrationsController::class, 'loginPerform'])->name('login.perform');
Route::post('logout', [RegistrationsController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', Index::class)->name('dashboard');
    

    Route::group(['middleware' => ['permission:2']], function () {
        Route::get('properties', [PropertiesController::class, 'index'])->name('properties.index');
        Route::get('properties/add', [PropertiesController::class, 'add'])->name('properties.add');
        Route::post('properties/store', [PropertiesController::class, 'store'])->name('properties.store');
        Route::get('properties/edit/{id}', [PropertiesController::class, 'edit'])->name('properties.edit');
        Route::post('properties/update', [PropertiesController::class, 'update'])->name('properties.update');
        Route::get('properties/{id}', [PropertiesController::class, 'show'])->name('properties.show');
        Route::DELETE('properties/destroy/{id}', [PropertiesController::class, 'destroy'])->name('properties.destroy');
    });

    // Route::get('properties/delete/{id}', [PropertiesController::class, 'destroy'])->name('organization.destroy');
    Route::group(['middleware' => ['permission:3']], function () {
        Route::resource('clients', ClientController::class);
    });
    Route::group(['middleware' => ['permission:4']], function () {
        Route::resource('providers', ProvidersController::class);
    });
    Route::group(['middleware' => ['permission:5']], function () {
        Route::resource('users', UsersController::class);
    });
    Route::group(['middleware' => ['permission:6']], function () {
        Route::resource('roles', RolesController::class);
    });

    // Route::group(['middleware' => ['permission:7']], function () {
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::get('fetchChat/{userId}', [ChatController::class, 'fetchChat']);
    Route::post('sendMessage', [ChatController::class, 'sendMessage']);
    // });

    Route::group(['middleware' => ['permission:8']], function () {
        Route::resource('menus', MenusController::class);
    });
    
    Route::group(['middleware' => ['permission:10']], function () {
        Route::resource('categories', CategoryController::class);
    });
    // Route::resource('permissions', permissionsController::class);
});


