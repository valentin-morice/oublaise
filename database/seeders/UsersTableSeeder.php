<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\App;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('admin'),
            ]);
        }
    }
}
