<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Models\Produk;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
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

Route::get('/', [LoginController::class, 'index']);
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/auth',[LoginController::class,'auth'])->name('auth');

Route::get('/dashboard', [ProdukController::class, 'landing']);
Route::get('/create', [ProdukController::class, 'create'])->name('create');
Route::post('/kirim-data', [ProdukController::class, 'store'])->name('kirim-data');
Route::get('/product', [ProdukController::class, 'show'])->name('product.data');
Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');
Route::patch('/update/{id}', [ProdukController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('delete');
