<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function logged(){
        return view('login');
    }

    public function login(Request $request){
        // validate
        $request->validate([
        'email' => 'required',
        'password'=> 'required',
        ]);

        if(\Auth::attempt($request->only('email','password'))){
            flash("User Has Been Successfully Login");
            return redirect()->route('medias.index');

        }
        return redirect('logged')->withError('Login details are not valid');

    }

    public function reg(){
        return view('register');
    }


    public function register(Request $request){
        $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|confirmed',

        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>\Hash::make($request->password)
        ]);

        if(\Auth::attempt($request->only('email','password'))){
            flash("User Has Been Successfully Register");
            return redirect()->route('medias.index');
        }
        return redirect('register')->withError('Error');

    }

    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect()->route('home');

}
}
