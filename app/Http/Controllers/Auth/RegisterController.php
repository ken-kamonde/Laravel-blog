<?php

namespace App\Http\Controllers\Auth;

use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        //validation 
        $this->validate($request, [
            'name' => 'required|max:20',
            'username' => 'required|max:20',
            'email' => 'required|email|max:50',
            'password' => 'required|confirmed',
        ]);

        //store the user 
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //sign the user in using auth helper 
        auth()->attempt($request->only('email', 'password'));

        //redirect 
        return redirect()->route('dashboard');
    }

}
