<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'foto_profil' =>'boby wibowo.jpg',
                'name' => 'Boby Wibowo',
                'email' => 'bobywib@gmail.com',
                'no_hp' => 628823454568,
                'password' => Hash::make('12345678'),
                'poin'=> 143,
                'rupiah'=>12.000,
                'alamat'=> 'https://maps.app.goo.gl/M1E1V8W1xADKwpqQ7',
                'rekening'=> '2134876830987',
                'no_dana' => '0891288812101'
            ],
        ];
        foreach ($users as $userItem){
            User::create($userItem);
        }
    }
}
