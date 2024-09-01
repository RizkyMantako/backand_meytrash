<?php

namespace Database\Seeders;

use App\Models\RiwayatDonasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $riwayat_donasi = [
            [
                'user_id' => 1,
                'donasi_id' => 1,
                'status' => 'Selesai',
            ],
            [
                'user_id' => 2,
                'donasi_id' => 3,
                'status' => 'Selesai',
            ],
            [
                'user_id' => 3,
                'donasi_id' => 6,
                'status' => 'Ditolak',
            ],
        ];
        foreach ($riwayat_donasi as $riwayat_donasiItem){
            RiwayatDonasi::create($riwayat_donasiItem);
        }
    }
}
