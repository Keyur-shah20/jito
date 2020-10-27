<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    public function home(){
       $users = User::select('id','first_name','last_name','email','phone')->get();
       return view('dashboard',['users'=>$users]);
    }
    public function user(){
        $users = User::select('id','first_name','last_name','email','phone')->get();
        return view('user/index',['users'=>$users]);
    }
}
