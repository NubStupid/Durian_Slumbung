<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\Guest;
use Illuminate\Http\Request;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\Auth\ProviderController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('homepage');
// })->name('home');


Route::get('/auth/{provider}/redirect',[ProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class,'callback']);


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
    Route::middleware('authen:A,M')->group(function () {
        // Route::prefix('admin')->group(function () {
            Route::get('/testDatabase',[UserController::class,"getCustomer"]);
        Route::get('/testTambah',[UserController::class,"loadFormTambah"]);
        Route::post('/testTambah',[UserController::class,"tambah"]);
        Route::get('/testUbah/{id}',[UserController::class,"loadFormUbah"]);
        Route::post('/testUbah/{id}',[UserController::class,"ubah"]);
        Route::middleware('role:A')->group(function(){
            Route::get('/adminhomepage',[AdminController::class,"dashboard"]);
            Route::get('/adminproduct',[AdminController::class,"adminProduct"]);
            Route::post('/adminproduct',[AdminController::class,"addProduct"]);
            Route::post('/adminproductView',[AdminController::class,"viewProduct"]);
            Route::post('/updateproduct/{id}', [AdminController::class, "updateProduct"]);
            Route::delete('/deleteproduct/{id}', [AdminController::class, "deleteProduct"]);
            Route::post('/searchadminproduct',[AdminController::class,"searchProduct"]);
        });
        Route::middleware('role:M')->group(function(){
            Route::get('/masterhomepage',[AdminController::class,"dashboard"]);
            Route::get('/productsreport',[AdminController::class,'productReport']);
            Route::get('/wisatareport',[AdminController::class,'wisataReport']);
            Route::post('/wisatareport',[AdminController::class,'filterWisata']);
            Route::get('/masteradmin',[AdminController::class,'masterAdmin']);
            Route::post('/searchAdmin',[AdminController::class,'searchAdmin']);
            Route::post('/masterAdminView',[AdminController::class,'viewAdmin']);
            Route::get('/masterChat', [PusherController::class,'index']);
            Route::post('/broadcast',  [PusherController::class,'broadcast']);
            Route::post('/receive',  [PusherController::class,'receive']);
            Route::get('/write',[AIController::class,'viewChat']);
            Route::post('/write/generate',[AIController::class,'promptChat']);
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

        Route::get('/profile', [PageController::class, 'loadProfileView']);
        Route::post('/profile/update-username', [PageController::class, 'updateUsername'])->name('update.username');
        Route::post('/profile/update-telp', [PageController::class, 'updateNoTelp'])->name('update.notelp');
        Route::post('/profile/update-gambar', [PageController::class, 'updateGambar'])->name('update.gambar');
        // Route::post('update-gambar', [PageController::class, 'updateGambar']);

        Route::get('/about', [PageController::class, "loadAboutView"]);

        // AJAX page wisata
        Route::post('/kalender',[PageController::class,'loadKalender']);
        Route::post('/sesi',[PageController::class,'loadSesi']);

        Route::get('/checkout',[TransactionController::class,'checkout']);
        Route::post('/checkout', [TransactionController::class, 'pay']);

        Route::get('/payment-success', function(){
            return view('payment-success');
        });

        Route::get('/invoice/{id}', [TransactionController::class, 'invoice']);

    });
    Route::middleware(['authen:user','role:user'])->group(function () {
        Route::get('/wisata/wisata',[PageController::class,'loadWisataViewLogin']);
        Route::post('/wisata/wisata',[PageController::class,'loadWisataViewLoggedIn'])->name('wisata');
        Route::get('/product/view/{id}',[PageController::class,"viewProduct"]);
        Route::post('/product/view/{id}',[PageController::class,"addCart"])->name('add-cart');
        Route::get('/cart',[PageController::class,"viewCart"]);
        Route::delete('/delete-cart-item/{id}',[PageController::class,"deleteCartItem"]);
        Route::get('/history',[PageController::class,"viewHistory"]);
        Route::post('/product/like',[RatingController::class,"insertUpdateRating"]);
        Route::post('/product/delete',[RatingController::class,"deleteRating"]);
        Route::post('/comments', [CommentController::class, 'addComment']);
        Route::post('/likes/add' ,[LikeController::class, 'addLike']);
        Route::post('/likes/delete' ,[LikeController::class, 'deleteLike']);
    });

// Logout (Session dorrr)
Route::get('/logout', function (Request $request) {
    session()->forget('username');
    if(Auth::guard('web')->check()){
        Auth::guard('web')->logout();
    }else if(Auth::guard('admin')->check()){
        Auth::guard('admin')->logout();
    }
    session()->forget('role');
    $request->session()->invalidate();

    $request->session()->regenerateToken();
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

// routes/web.php


