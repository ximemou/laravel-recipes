<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = User::create([
            'name'=> 'Ximena',
            'email'=> 'correo@correo.com',
            'password'=> Hash::make('123456789'),
            'url'=> 'http://codigoxime.com',
        ]);

        $user2 = User::create([
            'name'=> 'Pedro',
            'email'=> 'correo2@correo.com',
            'password'=> Hash::make('123456789'),
            'url'=> 'http://codigopedro.com',
        ]);
        
    }
}
