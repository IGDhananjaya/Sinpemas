<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ormas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ormas',
        'surat_permohonan',
        'surat_penetapan',
        'sk_susunan_kepengurusan',
        'alamat_sekretariat',
        'plang_nama_sekretariat',
        'surat_keterangan_domisili',
        'kontak_person',
        'nama_ketua',
        'nik_ketua',
        'ktp_ketua',
        'nama_sekretaris',
        'nik_sekretaris',
        'ktp_sekretaris',
        'nama_bendahara',
        'nik_bendahara',
        'ktp_bendahara',
        'status', // Pastikan kolom status tetap ada
        'user_id',
        'bentuk_organisasi_id', // Gunakan ini jika bentuk organisasi adalah relasi
    ];

    // Mutator untuk mengubah bentuk_organisasi ke dalam format JSON
    protected $casts = [
        'bentuk_organisasi' => 'array', // Jika ini adalah array
    ];

    // Definisi relasi status
    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }

    // Definisi relasi bidang
    public function bidang()
    {
        return $this->belongsToMany(bidang::class, 'bidang_ormas', 'ormas_id', 'bidang_id');
    }

    public function bentukOrganisasi(): BelongsTo
    {
        return $this->belongsTo(bentuk_organisasi::class, 'bentuk_organisasi_id');
    }
}
