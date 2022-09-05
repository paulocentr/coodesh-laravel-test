<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::name('site.')->group(function() {
    Route::get('/', [SiteController::class, 'home'])->name('home');
    Route::post('convert', [SiteController::class, 'convert'])->name('convert');
    Route::get('conversions', [SiteController::class, 'getConvertions'])->name('conversions');
});

