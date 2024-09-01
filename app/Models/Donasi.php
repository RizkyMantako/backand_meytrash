<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proses_donasi()
    {
        return $this->hasOne(ProsesDonasi::class);
    }

    public function riwayat_donasi()
    {
        return $this->hasOne(RiwayatDonasi::class);
    }

    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'alamat',
        'foto_makanan',
        'berat_makanan',
        'jenis_donasi',
        'poin_transaksi',
        'jenis_makanan',
        'deskripsi',
        'status',
    ];
}
