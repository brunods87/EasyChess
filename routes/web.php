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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/api/requestGame', [App\Http\Controllers\GameInstanceController::class, 'requestGame'])->name('requestGame');
Route::post('/api/syncronizeUp', [App\Http\Controllers\GameInstanceController::class, 'syncUp'])->name('syncUp');
Route::post('/api/syncronizeDown', [App\Http\Controllers\GameInstanceController::class, 'syncDown'])->name('syncDown');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{token}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
