<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'sampul',
        'judul',
        'sumber',
        'link_url',
        'deskripsi',
        'tags',
    ];

    protected $visible = ['id', 'sampul', 'judul','sumber','link_url', 'deskripsi', 'tags', 'sampul_link'];
    protected $appends = ['sampul_link'];

    public function getSampulLinkAttribute()
    {
        // Pastikan bahwa kolom 'sampul' sesuai dengan struktur penyimpanan Anda
        return asset('storage/' . $this->sampul);
    }
}
