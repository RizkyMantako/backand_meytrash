<?php

namespace Database\Seeders;

use App\Models\Edukasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EdukasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $edukasi = [
            [
                'sampul' => 'artikel kkn undipo.jpg',
                'judul' => 'Food Waste',
                'link_url' => 'http://kkn.undip.ac.id/?p=305408',
                'deskripsi' => 'Maraknya fenomena food waste yang terjadi di Indonesia merupakan salah satu indikasi kurangnya pengetahuan warga akan food waste dan bagaimana cara mengatasinya. Food waste sendiri merupakan salah satu istilah dalam bahasa Inggris yang memiliki pengertian makanan siap saji yang terbuang begitu saja dan akhirnya menumpuk di TPA. Sangat disayangkan fenomena food waste ini lah yang menjadi penyumbang terbesar pada permasalahan sampah di Indonesia. Melihat banyaknya fenomena yang terjadi terkait dengan sampah limbah makanan, tim KKN II UNDIP melakukan sosialisasi tentang apa itu food waste dan bagaimana cara mengurangi atau pun menanggulanginya. Sasaran dari sosialisasi yang dilakukan ini adalah ibu-ibu yang tinggal di RW 5 pada kelurahan Muktiharjo Lor',
                'tags' => json_encode ([
                    'food waste',
                    'sampah makanan',
                    'indonesia',
                    'semarang',
                    'kkn',
                    'mahasiswa',
                ]),
            ],
            [
                'sampul' => 'artikel kompas.jpg',
                'judul' => 'Food Waste Indonesia',
                'link_url' => 'https://lestari.kompas.com/read/2023/05/16/190000086/indonesia-peringkat-4-food-waste-terbanyak-di-dunia',
                'deskripsi' => 'Indonesia menempati peringkat keempat di dunia dengan food waste atau mubazir makanan paling banyak di dunia pada 2020. Food waste atau mubazir makanan adalah makanan yang siap disantap tapi terbuang begitu saja dan menjadi sampah. Dilansir dari Statista, food waste atau mubazir makanan yang dihasilkan sektor rumah tangga di Indonesia pada 2020 mencapai 20,94 juta metrik ton. Secara berurutan, total mubazir makanan Indonesia berada di bawah China dengan 91,65 juta metrik ton, India dengan 68,76 juta metrik ton, dan Nigeria dengan 37,94 juta metrik ton.',
                'tags' => json_encode ([
                    'food waste',
                    'sampah makanan',
                    'indonesia',
                    'food waste dunia',
                    'food waste indonesia',
                    'posisi food waste indonesia',
                ]),
            ],
        ];
        foreach ($edukasi as $edukasiItem){
            Edukasi::create($edukasiItem);
        }
    }
}
