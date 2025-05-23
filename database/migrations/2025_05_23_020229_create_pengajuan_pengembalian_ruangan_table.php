<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_pengembalian_ruangan', function (Blueprint $table) {
            $table->id('pengajuan_pengembalian_id');
            $table->foreignId("peminjaman_id")->constrained('peminjaman_ruangan', 'peminjaman_id');
            $table->foreignId('user_id')->constained('users');
            $table->enum('status', ['belum_disetujui', 'disetujui'])->default('belum_disetujui');
            $table->dateTime('tanggal_pengajuan');
            $table->dateTime('tanggal_disetujui')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pengembalian_ruangan');
    }
};
