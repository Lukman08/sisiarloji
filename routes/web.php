<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataUserController;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/loginadmin', [LoginController::class, 'loginadmin'])->name('loginadmin');
Route::post('/adminlogin', [LoginController::class, 'adminlogin'])->name('adminlogin');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth', 'hakakses:admin']],function(){
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
    Route::get('/datauser', [DataUserController::class, 'datauser'])->name('datauser');
    Route::get('/tambahuser', [DataUserController::class, 'tambahuser'])->name('tambahuser');
    Route::post('/insertuser', [DataUserController::class, 'insertuser'])->name('insertuser');
});

Route::group(['middleware' => ['auth', 'hakakses:user']],function(){
    Route::get('/pembeli', function () {
        return view('layout.pembeli');
    });
});
