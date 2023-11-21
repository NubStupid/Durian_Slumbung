<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\PageController;
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
    return view('homepage');
});
Route::get('/product',[PageController::class,'loadProductsView']) ;
Route::post('/product',[PageController::class, "searchProduct"]);
Route::get('/product/view/{id}',[PageController::class,"viewProduct"]);
// testing
Route::get('/testDatabase',[UserController::class,"getCustomer"]);
Route::get('/testTambah',[UserController::class,"loadFormTambah"]);
Route::post('/testTambah',[UserController::class,"tambah"]);
Route::get('/testUbah/{id}',[UserController::class,"loadFormUbah"]);
Route::post('/testUbah/{id}',[UserController::class,"ubah"]);
/*
    Error View
    (Pastikan di paling bawah routenya :D )
*/

// Paling bawah
Route::get('/{any}',function(){
    return view('error.404');
});
