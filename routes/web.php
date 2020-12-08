<?php

use App\Http\Controllers\InvoicesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    return view('welcome', ['user' => Auth::user()]);
})->middleware('auth');

Route::get('/invoice/{uri}', [InvoicesController::class, 'payPage'])->name('invoice');
Route::post('/invoice/{uri}', [InvoicesController::class, 'pay'])->name('pay');

Route::get('login', function () {
    return view('auth');
})->name('login');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::post('login', [LoginController::class, 'authenticate']);
