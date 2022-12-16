<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function datauser(Request $request){
        if($request->has('cari')){
            $data = User::where('name', 'LIKE', '%' .$request->cari.'%')->simplePaginate(5);
        }else{
            $data = User::where('role', 'user')->simplePaginate(5);
        }
        return view('admin.datauser.index', compact('data'));
    }

    public function tambahuser(){
        return view('admin.datauser.tambah');
    }

    public function insertuser(Request $request){
        User::create(['name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
        'password' => bcrypt($request->password),
        'role' =>$request->role,
    ]);
        return redirect()->route('datauser');
    }

    public function deleteuser($id) {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('datauser')->with('success', 'berhasil dihapus');
    }

    public function resetpassword($id){
        $data = User::find($id)->update([
            'password' => bcrypt('password')
        ]);
        return redirect()->route('datauser')->with('acc', 'berhasil direset.');
    }
}
