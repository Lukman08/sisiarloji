<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/loginadmin', [LoginController::class, 'loginadmin'])->name('loginadmin');
Route::post('/adminlogin', [LoginController::class, 'adminlogin'])->name('adminlogin');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'hakakses:admin']],function(){  
    Route::get('/dashboard', [LoginController::class, 'admin'])->name('admin');
    Route::get('/datauser', [DataUserController::class, 'datauser'])->name('datauser');
    Route::get('/tambahuser', [DataUserController::class, 'tambahuser'])->name('tambahuser');
    Route::post('/insertuser', [DataUserController::class, 'insertuser'])->name('insertuser');

    Route::get('/produk', [ProdukController::class, 'produk'])->name('produk');
    Route::get('/tambahproduk', [ProdukController::class, 'tambahproduk'])->name('tambahproduk');
    Route::post('/insertproduk', [ProdukController::class, 'insertproduk'])->name('insertproduk');
    Route::get('/editproduk/{id}', [ProdukController::class, 'editproduk'])->name('editproduk');
    Route::post('/updateproduk/{id}', [ProdukController::class, 'updateproduk'])->name('updateproduk');
    Route::get('/deleteproduk/{id}', [ProdukController::class, 'deleteproduk'])->name('deleteproduk');
});

Route::group(['prefix'=>'pembeli', 'middleware' => ['auth', 'hakakses:user']],function(){
    Route::get('/dashboard', [ProdukController::class, 'userproduk'])->name('pembeli');
});
