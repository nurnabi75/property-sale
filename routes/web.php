<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\LocationController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewPropertyController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
    Route::get(  '/', [HomeController::class, 'home'])->name('home');
Route::get(  '/property/{id}', [NewPropertyController::class, 'single'])->name('single-property');
Route::get('/location/{id}', [HomeController::class, 'singleLocation'])->name('single-location');

Route::get(  '/properties', [NewPropertyController::class, 'index'])->name('properties');
Route::get(  '/page/{slug}' , [PageController::class, 'single'])->name('page');
Route::post(  '/property-inquiry/{id}' , [ContactController::class, 'propertyInquiry'])->name('property-inquiry');

//currency
Route::get(  '/currency/{code}' , [HomeController::class, 'currencyChange'])->name('currency-change');

});

// admin routes

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-index');

    Route::get('/dashboard/properties', [DashboardController::class, 'properties'])->name('dashboard-properties');

    Route::get('/dashboard/add-property', [DashboardController::class, 'addProperty'])->name('add-property');

    Route::post('/dashboard/create-property', [DashboardController::class, 'createProperty'])->name('create-property');

    Route::post('/dashboard/update-property/{id}', [DashboardController::class, 'updateProperty'])->name('update-property');

    Route::post('/dashboard/delete-property/{id}', [DashboardController::class, 'deleteProperty'])->name('delete-property');

    Route::get('/dashboard/edit-property/{id}', [DashboardController::class, 'editProperty'])->name('edit-property');

    Route::post('/dashboard/delete-media/{media_id}', [DashboardController::class, 'deleteMedia'])->name('delete-media');

    //page
    Route::resource(  'dashboard-page', PageController::class);
    //location
    Route::resource('dashboard-location', LocationController::class);
});




require __DIR__.'/auth.php';
