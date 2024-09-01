<?php

namespace Database\Seeders;

use App\Models\Sampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampah = [
            [
                'user_id' => 1,
                'nama' => 'Boby Wibowo',
                'no_hp' => 628823454568,
                'alamat'=> 'https://maps.app.goo.gl/M1E1V8W1xADKwpqQ7',
                'foto_sampah' => 'sampah1.jpg',
                'deskripsi' => 'sampah sudah 3 hari pak',
                'berat_sampah' => 3,
                'status' => 'terverifikasi',
            ],
            [
                'user_id' => 2,
                'nama' => 'Agnes Cristi',
                'no_hp' => 6281345876996,
                'alamat'=> 'https://maps.app.goo.gl/NrhNviXHvsN3CvZU9',
                'foto_sampah' => 'sampah2.jpg',
                'deskripsi' => 'sampah sudah 2 hari pak',
                'berat_sampah' => 2,
                'status' => 'terverifikasi',
            ],
        ];
        foreach ($sampah as $sampahItem){
            Sampah::create($sampahItem);
        }
    }
}
