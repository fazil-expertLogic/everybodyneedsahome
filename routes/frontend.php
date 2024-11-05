<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProvidersController;
use App\Http\Controllers\Site\FrontendController;
use App\Http\Livewire\Index;

//Dashbaord
Route::get('dashboard', Index::class);

Route::get('index', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// Route::get('/', function () {
//     return view('site.index');
// })->name('index');
Route::get('/about-us', function () {
    return view('site.about-us');
})->name('about-us');
// Route::get('/buy-property-grid', function () {
//     return view('site.buy-property-grid');
// })->name('buy-property-grid');

Route::get('/', [FrontendController::class, 'home'])->name('index');
Route::get('buy-property-grid', [FrontendController::class, 'buyPropertyGrid'])->name('buy_property_grid');
Route::get('pricing', [FrontendController::class, 'pricing'])->name('pricing');
Route::get('property-list', [FrontendController::class, 'propertyList'])->name('property-list');
Route::get('property-detail/{id}', [FrontendController::class, 'propertyDetail'])->name('property-detail');


// Route::get('property-detail/{id}', function ($id) {
//     return view('site.buy-details');
// })->name('buy-details');

Route::get('/login', function () {
    return view('site.login');
})->name('login');
Route::get('/reset-password', function () {
    return view('site.reset-password');
})->name('reset-password');

Route::get('/forgot-password', function () {
    return view('site.forgot-password');
})->name('forgot-password');

Route::get('/register', function () {
    return view('site.register');
})->name('register');

Route::get('/contact-us', function () {
    return view('site.contact-us');
})->name('contact-us');





Route::get('/rent-property-grid', function () {
    return view('site.rent-property-grid');
})->name('rent-property-grid');

Route::get('/rent-property-list', function () {
    return view('site.rent-property-list');
})->name('rent-property-list');

Route::get('/rent-property-grid-sidebar', function () {
    return view('site.rent-property-grid-sidebar');
})->name('rent-property-grid-sidebar');

Route::get('/rent-property-list-sidebar', function () {
    return view('site.rent-property-list-sidebar');
})->name('rent-property-list-sidebar');

Route::get('/rent-grid-map', function () {
    return view('site.rent-grid-map');
})->name('rent-grid-map');

Route::get('/rent-list-map', function () {
    return view('site.rent-list-map');
})->name('rent-list-map');

Route::get('/rent-details', function () {
    return view('site.rent-details');
})->name('rent-details');

Route::get('/rental-order-step1', function () {
    return view('site.rental-order-step1');
})->name('rental-order-step1');

Route::get('/rental-order-step2', function () {
    return view('site.rental-order-step2');
})->name('rental-order-step2');

Route::get('/rental-order-step3', function () {
    return view('site.rental-order-step3');
})->name('rental-order-step3');

Route::get('/rental-order', function () {
    return view('site.rental-order');
})->name('rental-order');




Route::get('/buy-property-list', function () {
    return view('site.buy-property-list');
})->name('buy-property-list');



Route::get('/buy-property-grid-sidebar', function () {
    return view('site.buy-property-grid-sidebar');
})->name('buy-property-grid-sidebar');

Route::get('/buy-grid-map', function () {
    return view('site.buy-grid-map');
})->name('buy-grid-map');

Route::get('/buy-list-map', function () {
    return view('site.buy-list-map');
})->name('buy-list-map');

Route::get('/agent-grid', function () {
    return view('site.agent-grid');
})->name('agent-grid');

Route::get('/agent-list', function () {
    return view('site.agent-list');
})->name('agent-list');

Route::get('/agent-grid-sidebar', function () {
    return view('site.agent-grid-sidebar');
})->name('agent-grid-sidebar');

Route::get('/agent-list-sidebar', function () {
    return view('site.agent-list-sidebar');
})->name('agent-list-sidebar');

Route::get('/agent-details', function () {
    return view('site.agent-details');
})->name('agent-details');

Route::get('/buy-detail-view', function () {
    return view('site.buy-detail-view');
})->name('buy-detail-view');
Route::get('/blog-list', function () {
    return view('site.blog-list');
})->name('blog-list');

Route::get('/blog-grid', function () {
    return view('site.blog-grid');
})->name('blog-grid');
Route::get('/blog-details', function () {
    return view('site.blog-details');
})->name('blog-details');
Route::get('/agency-details', function () {
    return view('site.agency-details');
})->name('agency-details');

Route::get('/agency-grid-sidebar', function () {
    return view('site.agency-grid-sidebar');
})->name('agency-grid-sidebar');

Route::get('/agency-grid', function () {
    return view('site.agency-grid');
})->name('agency-grid');

Route::get('/agency-list-sidebar', function () {
    return view('site.agency-list-sidebar');
})->name('agency-list-sidebar');

Route::get('/agency-list', function () {
    return view('site.agency-list');
})->name('agency-list');

Route::get('/coming-soon', function () {
    return view('site.coming-soon');
})->name('coming-soon');

Route::get('/compare', function () {
    return view('site.compare');
})->name('compare');

Route::get('/error-404', function () {
    return view('site.error-404');
})->name('error-404');

Route::get('/error-500', function () {
    return view('site.error-500');
})->name('error-500');

Route::get('/faq', function () {
    return view('site.faq');
})->name('faq');

Route::get('/gallery', function () {
    return view('site.gallery');
})->name('gallery');

Route::get('/invoice-details', function () {
    return view('site.invoice-details');
})->name('invoice-details');

Route::get('/maintenance', function () {
    return view('site.maintenance');
})->name('maintenance');

Route::get('/our-team', function () {
    return view('site.our-team');
})->name('our-team');



Route::get('/privacy-policy', function () {
    return view('site.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-condition', function () {
    return view('site.terms-condition');
})->name('terms-condition');

Route::get('/testimonial', function () {
    return view('site.testimonial');
})->name('testimonial');



Route::get('/add-new-property-rental', function () {
    return view('site.add-new-property-rental');
})->name('add-new-property-rental');

Route::get('/add-new-property', function () {
    return view('site.add-new-property');
})->name('add-new-property');

Route::get('client-registration', [ClientController::class, 'client_registration_website'])->name('clients.client_registration');
Route::post('client-registration_post', [ClientController::class, 'store'])->name('clients.client_registration_post');

Route::get('provider-registration', [ProvidersController::class, 'provider_registration_website'])->name('providers.provider_registration');
Route::post('provider-registration-post', [ProvidersController::class, 'store'])->name('providers.provider_registration_post');
