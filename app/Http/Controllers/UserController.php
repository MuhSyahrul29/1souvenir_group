<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('user.crud.create', compact('roles'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ];

        User::create($data);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
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
