<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPengembalian extends Model
{
    protected $table = 'pengajuan_pengembalian_ruangan';

    protected $guarded = 'pengajuan_pengembalian_id';

    public function peminjaman() {
        return $this->belongsTo(PeminjamanRuangan::class, 'peminjaman_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
