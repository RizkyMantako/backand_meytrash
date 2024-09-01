<?php

namespace Database\Seeders;

use App\Models\Proses;
use App\Models\ProsesSampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProsesSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proses_sampah = [
            [
                'user_id' => 1,
                'sampah_id' => 1,
                'status' => 'In Proses',
            ],
            [
                'user_id' => 3,
                'sampah_id' => 9,
                'status' => 'In Proses',
            ],
        ];
        foreach ($proses_sampah as $proses_sampahItem){
            ProsesSampah::create($proses_sampahItem);
        }
    }
}
