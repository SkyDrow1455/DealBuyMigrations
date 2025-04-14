<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrmController extends Controller
{
    //
    public function consultas(){
        $user = User::find(1);

        return $user->product;
    }
}
