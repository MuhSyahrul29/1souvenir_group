<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;

class PelangganConrtroller extends Controller
{
    public function dashboard()
    {
        return view('pelanggan.dashboard.index');
    }
}
