<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Auth\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $karyawanRole = Role::where('name', 'karyawan')->first();
        $pelangganRole = Role::where('name', 'karyawan')->first();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => $adminRole->id,
        ]);


        User::create([
            'name' => 'karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => $karyawanRole->id,
        ]);

        User::create([
            'name' => 'pelanggan',
            'email' => 'pelanggan@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => $pelangganRole->id,
        ]);
    }
}
