<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView(){
        return view('loginView');
    }

    public function login(Request $request){
        $input=['email'=>request('email'),'password'=>request('password')];

        if (Auth::attempt($input,true)){
            return redirect()->route('booksView');
        }
        else{
            return redirect()->route('loginView')->with('message','Invalid User');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('loginView');
    }
}
