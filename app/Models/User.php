<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;


    public function sampah()
    {
        return $this->hasMany(Sampah::class);
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }

    public function proses_sampah()
    {
        return $this->hasMany(ProsesSampah::class);
    }

    public function riwayat_sampah()
    {
        return $this->hasMany(RiwayatSampah::class);
    }

    public function proses_donasi()
    {
        return $this->hasMany(ProsesDonasi::class);
    }

    public function riwayat_donasi()
    {
        return $this->hasMany(RiwayatDonasi::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'foto_profil',
        'name',
        'email',
        'no_hp',
        'no_dana',
        'password',
        'poin',
        'rupiah',
        'alamat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
