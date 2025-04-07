<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/createUser', [Usercontroller::class, 'createUser'])->name('createUser');
Route::post('/crearUsuario',[UserController::class,'store'])->name('user.store');
