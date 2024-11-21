<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login_proses(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user(); // Ambil pengguna yang berhasil login

        // Periksa role pengguna dan arahkan ke dashboard yang sesuai
        if ($user->role && $user->role->name === 'admin') {
            return redirect()->route('admin.dashboard'); // Dashboard untuk Admin
        } elseif ($user->role && $user->role->name === 'karyawan') {
            return redirect()->route('karyawan.dashboard'); // Dashboard untuk Karyawan
        }

        // Default jika role tidak dikenali
        Auth::logout();
        return redirect()->route('login')->with('error', 'Role ti dak dikenali.');
    }

    // Jika login gagal
    return redirect()->route('login')->with('error', 'Email atau Password salah.');
}

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Berhasil Logout');
    }

    public function register(){
        return view('auth.register');
    }

    public function register_proses(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($login)){
            return redirect()->route('dashboard');
        }else {
            return redirect()->route('login')->with('error','Email atau Password Salah');
        };

    }
}
