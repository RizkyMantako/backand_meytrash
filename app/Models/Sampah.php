<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proses_sampah()
    {
        return $this->hasOne(ProsesSampah::class);
    }

    public function riwayat_sampah()
    {
        return $this->hasOne(RiwayatSampah::class);
    }

    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'alamat',
        'foto_sampah',
        'berat_sampah',
        'poin_transaksi',
        'deskripsi',
        'status',
    ];
}
