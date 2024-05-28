<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            # code...
            $user = new User;
            $user->user_name = 'admin' . $i;
            $user->email = 'admin' . $i . '@gmail.com';
            $user->password =  Hash::make('matkhau');
            $user->role_id = 1;
            $user->is_deleted = 1;
            $user->save();
        }
    }
}
