<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginadmin(){
        return view('admin.login');
    }

    public function adminlogin(Request $request){
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('admin');
        }
        return view('admin.login');
    }

    public function login(){
        return view('login');
    }
    
    public function loginproses(Request $request){
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('pembeli');
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

    public function  pembeli(){
        return view('pembeli.dashboard');
    }

    public function index(){
        $data = Produk::orderBy('id', 'DESC')->simplePaginate(4);
        return view('welcome', compact('data'));
    }
}
