<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ChatController;
use App\Http\Controllers\Dashboard\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Dashboard\RegistrationsController;
use App\Http\Controllers\Dashboard\PropertiesController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProvidersController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\MenusController;
use App\Http\Controllers\Dashboard\MembershipController;
use App\Http\Controllers\Dashboard\AmenitiesController;
use App\Http\Controllers\Dashboard\StatesController;
use App\Http\Controllers\Dashboard\PropertyReviewController;
use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\Dashboard\PageContentController;
use App\Http\Controllers\Dashboard\PurchasePlanController;
use App\Http\Controllers\Dashboard\PlanMenusController;
use App\Http\Controllers\Dashboard\PlanPermissionsController;


use App\Http\Controllers\Site\CustomAuthController;
use App\Http\Controllers\Site\FrontendController;
use App\Http\Livewire\Index;

//Dashbaord

require __DIR__ . '/frontend.php';

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    return 'Cache cleared successfully';
});

Route::get('login', [RegistrationsController::class, 'showLogin'])->name('login');
Route::post('loginPerform', [RegistrationsController::class, 'loginPerform'])->name('login.perform');
Route::get('logout', [RegistrationsController::class, 'logout'])->name('logout');
Route::post('search-properties', [FrontendController::class, 'searchProperties'])->name('search-properties');


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', Index::class)->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::get('clients/mail/{id}', [ClientController::class, 'composeMail'])->name('clients.mail');
    Route::post('clients/message', [ClientController::class, 'sendMail'])->name('clients.send-mail');
    Route::get('clients/inbox/{id}', [ClientController::class, 'inbox'])->name('clients.inbox');
    Route::get('mail/read/{id}', [ClientController::class, 'mailReadView'])->name('mail.read');



    Route::group(['middleware' => ['permission:2']], function () {

        Route::get('my-properties', [PropertiesController::class, 'index'])->name('properties.index');
        Route::get('my-properties/add', [PropertiesController::class, 'add'])->name('properties.add');
        Route::post('my-properties/store', [PropertiesController::class, 'store'])->name('properties.store');
        Route::get('my-properties/edit/{id}', [PropertiesController::class, 'edit'])->name('properties.edit');
        Route::post('my-properties/update', [PropertiesController::class, 'update'])->name('properties.update');
        Route::get('my-properties/{id}', [PropertiesController::class, 'show'])->name('properties.show');
        Route::DELETE('my-properties/destroy/{id}', [PropertiesController::class, 'destroy'])->name('properties.destroy');
        Route::get('my-properties-export', [PropertiesController::class, 'export'])->name('properties.export');
        Route::post('my-properties-import', [PropertiesController::class, 'import'])->name('properties.import');
    });

    // Route::get('properties/delete/{id}', [PropertiesController::class, 'destroy'])->name('organization.destroy');
    Route::group(['middleware' => ['permission:3']], function () {
        Route::resource('clients', ClientController::class);
    });
    Route::group(['middleware' => ['permission:4']], function () {
        Route::resource('providers', ProvidersController::class);
        Route::get('providers-export', [ProvidersController::class, 'export'])->name('providers.export');
        Route::post('providers-import', [ProvidersController::class, 'import'])->name('providers.import');
    });
    Route::group(['middleware' => ['permission:5']], function () {
        Route::resource('users', UsersController::class);
        Route::get('users-export', [UsersController::class, 'export'])->name('users.export');
        Route::post('users-import', [UsersController::class, 'import'])->name('users.import');
    });
    Route::group(['middleware' => ['permission:6']], function () {
        Route::resource('roles', RolesController::class);
        Route::get('roles-export', [RolesController::class, 'export'])->name('roles.export');
        Route::post('roles-import', [RolesController::class, 'import'])->name('roles.import');
    });

    // Route::group(['middleware' => ['permission:7']], function () {
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::get('fetchChat/{userId}', [ChatController::class, 'fetchChat']);
    Route::post('sendMessage', [ChatController::class, 'sendMessage']);
    // });

    Route::group(['middleware' => ['permission:8']], function () {
        Route::resource('menus', MenusController::class);
        Route::get('menus-export', [MenusController::class, 'export'])->name('menus.export');
        Route::post('menus-import', [MenusController::class, 'import'])->name('menus.import');
    });

    Route::group(['middleware' => ['permission:10']], function () {
        Route::resource('categories', CategoryController::class);
    });

    Route::group(['middleware' => ['permission:13']], function () {
        Route::resource('memberships', MembershipController::class);
        Route::get('assign-permission/{id}', [MembershipController::class, 'assign_permission'])->name('assign_permission');
        Route::post('post-assign-permission', [MembershipController::class, 'post_assign_permission'])->name('post_assign_permission');
        Route::get('memberships-export', [MembershipController::class, 'export'])->name('memberships.export');
        Route::post('memberships-import', [MembershipController::class, 'import'])->name('memberships.import');
    });

    Route::group(['middleware' => ['permission:15']], function () {
        Route::resource('amenities', AmenitiesController::class);
        Route::get('amenities-export', [AmenitiesController::class, 'export'])->name('amenities.export');
        Route::post('amenities-import', [AmenitiesController::class, 'import'])->name('amenities.import');
    });

    Route::group(['middleware' => ['permission:15']], function () {
        Route::resource('states', StatesController::class);
        Route::get('states-export', [StatesController::class, 'export'])->name('states.export');
        Route::post('states-import', [StatesController::class, 'import'])->name('states.import');
    });

    Route::group(['middleware' => ['permission:15']], function () {
        Route::resource('states', StatesController::class);
    });

    Route::group(['middleware' => ['permission:17']], function () {
        Route::resource('propertyReview', PropertyReviewController::class);
        Route::get('propertyReview-export', [PropertyReviewController::class, 'export'])->name('propertyReview.export');
        Route::post('propertyReview-import', [PropertyReviewController::class, 'import'])->name('propertyReview.import');
    });

    Route::group(['middleware' => ['permission:18']], function () {
        Route::resource('guests', GuestController::class);
        Route::get('guests-export', [GuestController::class, 'export'])->name('guests.export');
        Route::post('guests-import', [GuestController::class, 'import'])->name('guests.import');
    });

    Route::group(['middleware' => ['permission:19']], function () {
        Route::resource('pageContents', PageContentController::class);
        Route::get('pageContents-export', [PageContentController::class, 'export'])->name('pageContents.export');
        Route::post('pageContents-import', [PageContentController::class, 'import'])->name('pageContents.import');
    });
    Route::group(['middleware' => ['permission:20']], function () {
        Route::resource('purchase_plans', PurchasePlanController::class);
        Route::get('purchase_plans-export', [PurchasePlanController::class, 'export'])->name('purchase_plans.export');
        Route::post('purchase_plans-import', [PurchasePlanController::class, 'import'])->name('purchase_plans.import');
    });
    Route::group(['middleware' => ['permission:21']], function () {
        Route::resource('plan_menus', PlanMenusController::class);
        Route::get('plan_menus-export', [PlanMenusController::class, 'export'])->name('plan_menus.export');
        Route::post('plan_menus-import', [PlanMenusController::class, 'import'])->name('plan_menus.import');
    });
});
