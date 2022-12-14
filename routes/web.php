<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\TransaksiController;

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
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'hakakses:admin']],function(){  
    Route::get('/dashboard', [LoginController::class, 'admin'])->name('admin');
    Route::get('/datauser', [DataUserController::class, 'datauser'])->name('datauser');
    Route::get('/tambahuser', [DataUserController::class, 'tambahuser'])->name('tambahuser');
    Route::post('/insertuser', [DataUserController::class, 'insertuser'])->name('insertuser');
    Route::get('/deleteuser/{id}', [DataUserController::class, 'deleteuser'])->name('deleteuser');
    Route::get('/resetpassword/{id}', [DataUserController::class, 'resetpassword'])->name('resetpassword');

    Route::get('/produk', [ProdukController::class, 'produk'])->name('produk');
    Route::get('/tambahproduk', [ProdukController::class, 'tambahproduk'])->name('tambahproduk');
    Route::post('/insertproduk', [ProdukController::class, 'insertproduk'])->name('insertproduk');
    Route::get('/editproduk/{id}', [ProdukController::class, 'editproduk'])->name('editproduk');
    Route::post('/updateproduk/{id}', [ProdukController::class, 'updateproduk'])->name('updateproduk');
    Route::get('/deleteproduk/{id}', [ProdukController::class, 'deleteproduk'])->name('deleteproduk');

    Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi');
    Route::get('/exportpdf', [TransaksiController::class, 'exportpdf'])->name('exportpdf');
    Route::get('/invoiceadmin/{id}', [TransaksiController::class, 'invoice'])->name('invoiceadmin');
    Route::get('/pesanan/{id}', [TransaksiController::class, 'cekbuktitf'])->name('cekbuktitf');
    Route::get('/downloadbuktitf/{id}', [TransaksiController::class, 'downloadbuktitf'])->name('downloadbuktitf');
    Route::get('/konfirmasitf/{id}', [TransaksiController::class, 'konfirmasitf'])->name('konfirmasitf');
    Route::get('/selesai/{id}', [TransaksiController::class, 'selesai'])->name('selesai');
});

Route::group(['prefix'=>'pembeli', 'middleware' => ['auth', 'hakakses:user']],function(){
    Route::get('/dashboard', [LoginController::class, 'pembeli'])->name('pembeli');
    Route::get('/belanja', [ProdukController::class, 'belanja'])->name('belanja');
    Route::get('/detailbelanja/{id}', [ProdukController::class, 'detailbelanja'])->name('detailbelanja');
    Route::post('/pesan/{id}', [TransaksiController::class, 'pesan'])->name('pesan');
    Route::get('/pesanlangsung/{id}', [TransaksiController::class, 'pesanlangsung'])->name('pesanlangsung');
    Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
    Route::get('/deleteco/{id}', [TransaksiController::class, 'deleteco'])->name('deleteco');
    Route::get('/transfer', [TransaksiController::class, 'transfer'])->name('transfer');
    Route::get('/langsung', [TransaksiController::class, 'langsung'])->name('langsung');
    Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayatdetail/{id}', [TransaksiController::class, 'riwayatdetail'])->name('riwayatdetail');
    Route::post('/buktitf/{id}', [TransaksiController::class, 'buktitf'])->name('buktitf');
    Route::get('/invoice/{id}', [TransaksiController::class, 'invoice'])->name('invoice');
});
