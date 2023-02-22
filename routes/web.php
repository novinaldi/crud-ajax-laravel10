<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout.home');
});
Route::get('/home', function () {
    return view('layout.home');
});
Route::get('/customer/form',[CustomerController::class,'form']);
Route::resource('customer',CustomerController::class);
