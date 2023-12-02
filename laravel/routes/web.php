<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RatingController;
use App\Http\Middleware\Guest;
use Illuminate\Http\Request;

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
})->name('home');

// Route Utama Login

// Login Cek
// Route::get('/login',function(){
//     return view('login');
// });
// Route::post('/login', [AuthController::class, "cekLogin"]);
// Route::post('/register', [AuthController::class, "cekRegister"]);
Route::post('/login/{type}',[AuthController::class,"checkCredentials"])->name('loginUser');

// Remember Me
Route::get('/login', function () {
    return view('login');
})->middleware([Guest::class])->name('login');
Route::get('/register', function () {
    return view('login',['register'=>'1']);
})->middleware([Guest::class])->name('register');

// Route::get('/homepage', function () {
    //     return view('homepage');
    // });


    // Semua Route Admin kalau mau di prefix jg bisa
    Route::middleware('authen:admin')->group(function () {
        // Route::prefix('admin')->group(function () {
            Route::get('/testDatabase',[UserController::class,"getCustomer"]);
        Route::get('/testTambah',[UserController::class,"loadFormTambah"]);
        Route::post('/testTambah',[UserController::class,"tambah"]);
        Route::get('/testUbah/{id}',[UserController::class,"loadFormUbah"]);
        Route::post('/testUbah/{id}',[UserController::class,"ubah"]);
        Route::get('/adminhomepage', function(){
            return view('adminhomepage');
        });
        // });
    });

    // Semua Route User
    Route::middleware('role:user')->group(function(){
        Route::get('/', function () {
            $user = request()->attributes->get('user');
            return view('homepage', ['user' => $user]);
        });
        Route::get('/product',[PageController::class,'loadProductsView']) ;
        Route::post('/product',[PageController::class, "searchProduct"]);

        Route::get('/wisata',[PageController::class,'loadWisataView']);
        
        Route::get('/checkout',[PageController::class,'checkout']);

    });
    Route::middleware(['authen:user','role:user'])->group(function () {
        Route::get('/product/view/{id}',[PageController::class,"viewProduct"]);
        Route::post('/product/view/{id}',[PageController::class,"addCart"])->name('add-cart');
        Route::get('/cart',[PageController::class,"viewCart"]);
        Route::post('/product/like',[RatingController::class,"insertUpdateRating"]);
        Route::post('/product/delete',[RatingController::class,"deleteRating"]);
    });

// Logout (Session dorrr)
Route::get('/logout', function (Request $request) {
    session()->forget('username');
    session()->forget('role');

    return redirect('login');
});

// Route::get('/checkout', 'checkout');

// testing
// Route::get('/testDatabase',[UserController::class,"getCustomer"]);
// Route::get('/testTambah',[UserController::class,"loadFormTambah"]);
// Route::post('/testTambah',[UserController::class,"tambah"]);
// Route::get('/testUbah/{id}',[UserController::class,"loadFormUbah"]);
// Route::post('/testUbah/{id}',[UserController::class,"ubah"]);
/*
    Error View
    (Pastikan di paling bawah routenya :D )
*/


// Paling bawah
Route::get('/{any}',function(){
    return view('error.404');
});
