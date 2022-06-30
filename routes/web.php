<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\manageDatabase;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/staradd', [manageDatabase::class, 'store'])->name('star.store'); 

Route::get('/delete', [manageDatabase::class, 'delete'])->name('star.delete');

Route::post('/starupdate', [manageDatabase::class, 'update'])->name('star.update'); 