<?php

namespace Database\Seeders;

use App\Models\RiwayatSampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $riwayat_sampah = [
            [
                'user_id' => 1,
                'sampah_id' => 1,
                'status' => 'In Proses',
            ],
        ];
        foreach ($riwayat_sampah as $riwayat_sampahItem){
            RiwayatSampah::create($riwayat_sampahItem);
        }
    }
}
