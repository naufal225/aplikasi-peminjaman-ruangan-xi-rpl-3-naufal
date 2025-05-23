<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $primaryKey = 'ruangan_id';

    protected $fillable = [
        'nama_ruangan', 'lokasi', 'kapasitas',
    ];

    public function peminjamanRuangan()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'ruangan_id', 'ruangan_id');
    }
}
