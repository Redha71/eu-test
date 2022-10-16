<?php

use App\Http\Controllers\weatherController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/weather', [weatherController::class, 'index'])->name('weather');
Route::get('/weatherapi', [weatherController::class, 'weatherCall'])->name('weatherapi');
Route::post('/store-city', [weatherController::class, 'storeCity'])->name('store-city');
require __DIR__.'/auth.php';
