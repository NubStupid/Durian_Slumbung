<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
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
