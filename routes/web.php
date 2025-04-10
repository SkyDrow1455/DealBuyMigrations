<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login-reg');
})->name('login');

Route::get('/createUser', [Usercontroller::class, 'createUser'])->name('createUser');
Route::post('/crearUsuario',[UserController::class,'store'])->name('user.store');

Route::get('/createRole', [RoleController::class, 'createRole'])->name('createRole');
Route::post('/crearRole',[RoleController::class,'rolle'])->name('role.rolle');