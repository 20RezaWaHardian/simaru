<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peminjam_id');
            $table->bigInteger('ruangan_id');
            $table->text('nama_kegiatan');
            $table->date('waktu_mulai_kegiatan')->nullable();
            $table->date('waktu_selesai_kegiatan')->nullable();
            $table->text('unit_pengguna')->nullable();
            $table->date('waktu_booking_peminjaman')->nullable();
            $table->string('penanggung_jawab_ruangan')->nullable();
            $table->string('penanggung_jawab_pengguna')->nullable();
            $table->integer('estimasi_peserta')->nullable();
            $table->tinyInteger('status_peminjaman')->default(0);
            $table->text('keterangan')->nullable();
            $table->text('dokumen_peminjaman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
