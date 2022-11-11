<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginadmin(){
        return view('admin.login');
    }

    public function adminlogin(Request $request){
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/admin');
        }
        return view('admin.login');
    }

    public function login(){
        return view('login');
    }
    
    public function loginproses(Request $request){
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/pembeli');
        }
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function registeruser(Request $request){
        // dd($request->all());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rememder_token' => Str::random(60),
        ]);
        return redirect('/login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function admin(){
        $datauser = User::count();
        $produk = Produk::count();
        return view('admin.dashboard', compact('datauser', 'produk'));
    }
}
