<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesDonasi extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    protected $guarded = ['id'];
}
