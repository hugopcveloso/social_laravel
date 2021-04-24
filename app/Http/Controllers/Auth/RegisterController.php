<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{

		public function __construct() 
		{
			$this->middleware(['guest']);
		}

    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
    	  //dd()  means die dump -> good to test
			$this->validate($request, [
				'name' => 'required|max:225',
				'username' => 'required|max:225',
				'email' => 'required|email|max:225',
				'password' => 'required|confirmed',
			]);
			//store user
			User::create([
				'name'=>$request->name,
				'email'=>$request->email,
				'username'=>$request->username,
				'password'=> Hash::make($request->password),
			]); 
			//sign the user in
			auth()->attempt($request->only('email','password')); //returns the UserModel

//redirect
			return redirect()->route('dashboard');
			
		
			
    }
}