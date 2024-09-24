<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*public function showLogin()
    {
    	return view('auth.login');
    }*/

    public function login(Request $request)
    {
    	$request->validate([

    		'email'=>'required|email',
    		'password'=>'required',
    	]);

    	if(Auth::attempt($request->only('email','password')))
    	{
    		return redirect()->intended('products');
    	}

    	return redirect()->back()->with('login_errors','Invalid Credentials');
    }

    public function register(Request $request)
    {
    	//Validation rules

    	$validator = Validator::make($request->all(),[

    		'name'=>'required|string|regex:/^[A-Za-z]+$/|max:100',
    		'email'=>'required|email|max:255|unique:users,email',
    		'password'=>'required|string|min:8|confirmed',
    	]);

    	if($validator->fails())
    	{
    	return redirect()->back()->withErrors($validator,'register')->withInput();
    	}

    	// Save user data in User table

    	$user = User::create([

    		'name'=>$request->name,
    		'email'=>$request->email,
    		'password'=>bcrypt($request->password),
    	]);

    	Auth::login($user);
    	return redirect()->route('products.index');
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login')->with('success','Logged out successfully');
    }

}
?>
