<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Irinel',
            'email' => 'irinel@gtre.it',
            'password' => Hash::make('ciaomama')
        ]);
    }
}
