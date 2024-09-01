<?php

namespace Database\Seeders;

use App\Models\Donasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donasi = [
            [
                'user_id' => 1,
                'nama' => 'Boby Wibowo',
                'no_hp' => 628823454568,
                'alamat'=> 'https://maps.app.goo.gl/M1E1V8W1xADKwpqQ7',
                'foto_makanan' => 'ikan goreng.jpg',
                'deskripsi' => 'masih dalam keadaan baik, baru digoreng tadi siang, didonasikan karna gorengnya kebanyakan',
                'jenis_makanan' => 'makanan',
                'berat_makanan' => 1,
                'status' => 'terverifikasi',
            ],
            [
                'user_id' => 2,
                'nama' => 'Agnes Cristi',
                'no_hp' => 6281345876996,
                'alamat'=> 'https://maps.app.goo.gl/NrhNviXHvsN3CvZU9',
                'foto_makanan' => 'sayur tumis.jpg',
                'deskripsi' => 'masih dalam keadaan baik, baru ditumis tadi siang, didonasikan untuk saudara yang membutuhkan',
                'jenis_makanan' => 'makanan',
                'berat_makanan' => 3,
                'status' => 'terverifikasi',
            ],
        ];
        foreach ($donasi as $donasiItem){
            Donasi::create($donasiItem);
        }
    }
}
