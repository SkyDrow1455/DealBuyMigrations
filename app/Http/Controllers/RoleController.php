<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function createRole(){

        return view('frmRoles');


    }

    public function rolle(Request $request){


        $role = new Role();
        $role->name=$request->name;
        $role->save();
        return $role;

    }
}
