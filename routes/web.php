<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/perangkat', [App\Http\Controllers\PerangkatController::class, 'index'])->name('perangkat');
Route::resource('/perangkat', 'App\Http\Controllers\PerangkatController');
Route::get('/statistik/{id}', [App\Http\Controllers\HomeController::class, 'statistik'])->name('statistik');
Route::get('/statistik/update/{id}', [App\Http\Controllers\HomeController::class, 'updateChart'])->name('updateChart');
