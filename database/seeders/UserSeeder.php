<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User:: create([
            'name' =>'Deo andreas',
            'level' =>'admin',
            'email' =>'deo1@gmail.com',
            'password' =>bcrypt('admin12345'),
            'remember_token' =>Str::random(60),
        ]);
        User:: create([
            'name' =>'Muhammad Rayhan',
            'level' =>'guru',
            'email' =>'rayhan1@gmail.com',
            'password' =>bcrypt('guru12345'),
            'remember_token' =>Str::random(60),
        ]);
        User:: create([
            'name' =>'Muhammad',
            'level' =>'siswa',
            'kelas' => 'X BFI',
            'email' =>'gutu1@gmail.com',
            'password' =>bcrypt('guru12345'),
            'remember_token' =>Str::random(60),
        ]);

       
    }
}
