<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // DB::table('users')->insert([
        //     'nama' => 'admin ilkom',
        //     'npm' => 12345678,
        //     'username' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('password'),
        //     'is_admin' => 1,
        //     'is_active' => 1
        // ]);
        $this->call([
            UserSeeder::class
        ]);
    }
}
