<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function saveuser(Request $request)
    {

        $request->validate([
            "name" =>"required",
            "email"=> "required",
            "password"=> "required",
        ]);

        return User::create($request->all());      
       
    }
}
