<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
     //Using the logout function from Admin dashboard
     public function logout(){
        Auth::logout();
        return redirect('home');
    }
     
}
