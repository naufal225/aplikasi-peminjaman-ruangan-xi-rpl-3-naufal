<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'id_card',
        'username',
        'password',
        'role',
        'jenis_pengguna',
        'nama_lengkap',
    ];

    protected $hidden = ['password'];

    public function peminjamanRuangan()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'user_id', 'user_id');
    }
}
