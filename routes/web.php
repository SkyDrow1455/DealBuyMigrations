<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\adminController;

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

Route::get('/p', function () {
    return view('prueba');
})->name('p');

Route::get('/d', function () {
    return view('admin.dashboard');
})->name('d');



Route::get('/login_admin', [adminController::class, 'login'])->name('login_admin');






Route::post('/chat', [ChatGPTController::class, 'askChatGPT']);

Route::post('/login-reg', [UserController::class, 'login'])->name('login');

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



