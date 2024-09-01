<?php

namespace Database\Seeders;

use App\Models\ProsesDonasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProsesDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proses_donasi = [
            [
                'user_id' => 1,
                'donasi_id' => 1,
                'status' => 'In Proses',
            ],
            [
                'user_id' => 2,
                'donasi_id' => 8,
                'status' => 'In Proses',
            ],
            [
                'user_id' => 3,
                'donasi_id' => 12,
                'status' => 'In Proses',
            ],
        ];
        foreach ($proses_donasi as $proses_donasiItem){
            ProsesDonasi::create($proses_donasiItem);
        }
    }
}
