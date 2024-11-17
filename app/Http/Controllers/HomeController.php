<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function index() {
        $data = User::get();

        return view('user.dashboard.index', compact('data'));
    }

    public function create(){
        return view('user.crud.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['name'] = $request-> nama;
        $data['email'] = $request-> email;
        $data['password'] = Hash::make($request-> password);

        User::create($data);
        return redirect()->route('admin.index');
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('user.crud.edit', compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'nama'      => 'required',
            'email'     => 'required|email',
            'password'  => 'nullable',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['name'] = $request-> nama;
        $data['email'] = $request-> email;

        if ($request->password){
            $data['password'] = Hash::make($request-> password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('admin.index');
    }

    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.index'); }

}