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
        } elseif ($user->role && $user->role->name === 'pelanggan')
            return redirect()->route('pelanggan.dashboard');

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

    // public function register_proses(Request $request){
    //     $request->validate([
    //         'nama' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:6',
    //     ]);

    //     $data = [
    //         'name' => $request->nama,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password)
    //     ];

    //     User::create($data);

    //     $login = [
    //         'email' => $request->email,
    //         'password' => $request->password
    //     ];

    //     if(Auth::attempt($login)){
    //         return redirect()->route('dashboard');
    //     }else {
    //         return redirect()->route('login')->with('error','Email atau Password Salah');
    //     };

    // }
    public function register_proses(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    // Cari ID role default (misalnya pelanggan)
    $defaultRoleId = \App\Models\Auth\Role::where('name', 'pelanggan')->value('id');

    // Buat pengguna baru dengan role default
    User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $defaultRoleId,
    ]);

    // Login pengguna setelah registrasi berhasil
    Auth::attempt($request->only('email', 'password'));

    // Redirect ke dashboard berdasarkan role
    $user = Auth::user();
    if ($user->role->name === 'admin') {
        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
    } elseif ($user->role->name === 'karyawan') {
        return redirect()->route('karyawan.dashboard')->with('success', 'Selamat datang, Karyawan!');
    } elseif ($user->role->name === 'pelanggan') {
        return redirect()->route('pelanggan.dashboard')->with('success', 'Selamat datang, Pelanggan!');
    }

    return redirect('/')->with('error', 'Role tidak dikenali.');
}

}
