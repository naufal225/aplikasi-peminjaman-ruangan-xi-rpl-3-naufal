<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    use HasFactory;

     protected $table = 'peminjaman_ruangan';
    protected $primaryKey = 'peminjaman_id';

    protected $fillable = [
        'user_id', 'ruangan_id', 'tanggal', 'waktu_mulai', 'durasi_pinjam', 'waktu_selesai', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'ruangan_id');
    }
}
