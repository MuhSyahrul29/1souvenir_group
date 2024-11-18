<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $data = User::with('role')->get();
        return view('user.dashboard.index', compact('data'));
    }

    public function create(){
        $roles = Role::all();
        return view('user.crud.create', compact('roles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|exists:roles,id', // Validasi role harus valid
    ]);

    // Simpan user dengan role_id
    $user = User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role, // Pastikan ini sesuai dengan input
    ]);

    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
}


    public function edit($id){
        $data = User::findOrFail($id);
        $roles = \App\Models\Auth\Role::all();
        return view('user.crud.edit', compact('data', 'roles'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function delete($id){
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
