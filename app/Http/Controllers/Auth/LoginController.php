<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //This function prevents a signned in user from visiting the login form 
    public function __construct(){
        $this->middleware(['guest']);
    }

    //This functions returns the login form 
    public function index() {
        return view('auth.login');
    }

    //This function is resposible for login the user
    public function store(Request $request) {
        
        //validation 
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //sign the user in using auth helper 
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'invalid login details');
        };

        //redirect 
        return redirect()->route('dashboard');
    }

}
