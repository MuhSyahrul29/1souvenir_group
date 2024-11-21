<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role && $user->role->name === 'admin') {
            return view('admin.dashboard.index');
        } elseif ($user->role && $user->role->name === 'karyawan') {
            return redirect()->route('karyawan.dashboard.index');
        } elseif ($user->role && $user->role->name === 'pelanggan') {
            return redirect()->route('pelanggan.dashboard.index');
        }

        return redirect()->route('login')->with('error', 'Role tidak dikenali.');
    }

}
