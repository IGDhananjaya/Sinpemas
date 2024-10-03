<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ormas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_ormas');
            $table->string('surat_permohonan'); // file harus diisi
            $table->unsignedBigInteger('bentuk_organisasi_id'); // Menambahkan kolom untuk bentuk organisasi
            $table->string('surat_penetapan'); // file harus diisi
            $table->string('sk_susunan_kepengurusan'); // file harus diisi
            $table->string('alamat_sekretariat');
            $table->string('plang_nama_sekretariat'); // foto harus diisi
            $table->string('surat_keterangan_domisili'); // file harus diisi
            $table->string('kontak_person');
            $table->string('nama_ketua');
            $table->string('nik_ketua');
            $table->string('ktp_ketua'); // foto harus diisi
            $table->string('nama_sekretaris');
            $table->string('nik_sekretaris');
            $table->string('ktp_sekretaris'); // foto harus diisi
            $table->string('nama_bendahara');
            $table->string('nik_bendahara');
            $table->string('ktp_bendahara'); // foto harus diisi
            $table->boolean('is_submitted')->default(false);
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Menambahkan relasi ke tabel users dan bentuk_organisasis
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bentuk_organisasi_id')->references('id')->on('bentuk_organisasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ormas');
    }
};
