<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OfferController;


Route::get('/', function () {
    return view('home');
});


Route::get('/check-mail', function () {
    return config('mail');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/loader', function () {
    return view('preloader');
})->name('loader');

Route::get('/bot', function () {
    return view('chatbot');
})->name('bot');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/d', function () {
    return view('admin.dashboard');
})->name('d');



//Route::get('/login_admin', [adminController::class, 'login'])->name('login_admin');






Route::post('/chat', [ChatGPTController::class, 'askChatGPT']);

Route::post('/login-reg', [UserController::class, 'login'])->name('login');
Route::get('/login-reg', function () {
    return view('login-reg');
})->name('login-reg');


Route::get('/login', [Usercontroller::class, 'createUser'])->name('login-reg');
Route::post('/crearUsuario',[UserController::class,'register'])->name('user.register');

Route::get('/createRole', [RoleController::class, 'createRole'])->name('createRole');
Route::post('/crearRole',[RoleController::class,'rolle'])->name('role.rolle');

Route::get('/ormConsultas',[OrmController::class,'consultas']);

Route::get('/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/add-product', [ProductController::class, 'store'])->name('products.store');


Route::get('/my-products', [ProductController::class, 'myProducts'])->name('myProducts');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/productos', [ProductController::class, 'allProducts'])->name('allProducts');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::resource('products', \App\Http\Controllers\ProductController::class);


<<<<<<< HEAD
Route::resource('offers', OfferController::class);

Route::post('offers/{id}/accept', [OfferController::class, 'accept'])->name('offers.accept');

Route::post('offers/{id}/reject', [OfferController::class, 'reject'])->name('offers.reject');

Route::post('offers/{id}/counteroffer', [OfferController::class, 'counteroffer'])->name('offers.counteroffer');







=======
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeProduct']);
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});
>>>>>>> 907ed6621f79880d93029905068df9ccfa07b259
