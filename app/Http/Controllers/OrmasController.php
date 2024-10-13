<?php

namespace App\Http\Controllers;

use App\Models\bentuk_organisasi;
use App\Models\bidang;
use App\Models\Ormas;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrmasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil akun pengguna yang sedang login
        $userId = auth()->id();

        // Ambil data Ormas yang terkait dengan akun pengguna,
        // termasuk relasi ke Bidang dan Bentuk Organisasi
        $ormas = Ormas::with(['bidang', 'bentukOrganisasi']) // Mengambil relasi
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('ormas.index', compact('ormas'));
    }

    // public function showSilomas()
    // {
    //     $ormas = Ormas::all(); // Ambil semua data Ormas
    //     return view('silomas', compact('ormas')); // Ganti 'silomas' dengan nama view Anda
    // }

    public function showSilomas()
    {
        // Ambil semua data Ormas yang terkait dengan relasi,
        // urutkan berdasarkan created_at dan paginasi
        $ormas = Ormas::with(['bentukOrganisasi', 'status']) // Mengambil relasi
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal dibuat
            ->paginate(10); // Batasi tampilan menjadi 10 item per halaman

        return view('silomas', compact('ormas')); // Ganti 'silomas' dengan nama view Anda
    }

    public function resume($id)
    {
        // $ormas = Ormas::findOrFail($id);
        // $ormas = Ormas::with('bidang')->findOrFail($id);
        $ormas = Ormas::with('bentukOrganisasi', 'bidang')->find($id);

        // Cek apakah sudah di-submit, kalau sudah tidak bisa mengakses halaman ini
        // if ($ormas->is_submitted) {
        //     return redirect()->route('ormas.index')->with('error', 'Data sudah di-submit.');
        // }

        return view('ormas.resume', compact('ormas'));
    }

    public function submitToAdmin($id)
    {
        $ormas = Ormas::findOrFail($id);

        // Cek apakah sudah di-submit, untuk menghindari double submit
        if ($ormas->is_submitted) {
            return redirect()->route('ormas.index')->with('error', 'Data sudah di-submit.');
        }

        // Ubah status menjadi submitted
        $ormas->is_submitted = true;
        $ormas->save();

        return redirect()->route('ormas.index')->with('success', 'Data berhasil di-submit ke admin.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data bidang dan bentuk organisasi
        $bidangs = bidang::all();
        $bentukOrganisasis = bentuk_organisasi::all();

        return view('ormas.create', compact('bidangs', 'bentukOrganisasis'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $validatedData = $request->validate([
    //         'nama_ormas' => 'required|string|max:255',
    //         'bentuk_organisasi_id' => 'required|exists:bentuk_organisasis,id',
    //         'bidang_id' => 'required|array', // Tetap di sini untuk validasi
    //         'bidang_id.*' => 'exists:bidangs,id',
    //         'surat_permohonan' => 'required|file|mimes:pdf|max:2048',
    //         'surat_penetapan' => 'required|file|mimes:pdf|max:2048',
    //         'sk_susunan_kepengurusan' => 'required|file|mimes:pdf|max:2048',
    //         'alamat_sekretariat' => 'required|string|max:255',
    //         'plang_nama_sekretariat' => 'required|file|mimes:jpg,png,jpeg|max:2048',
    //         'surat_keterangan_domisili' => 'required|file|mimes:pdf|max:2048',
    //         'kontak_person' => 'required|string|max:255',
    //         'nama_ketua' => 'required|string|max:255',
    //         'nik_ketua' => 'required|string|max:16',
    //         'ktp_ketua' => 'required|file|mimes:jpg,png,jpeg|max:2048',
    //         'nama_sekretaris' => 'required|string|max:255',
    //         'nik_sekretaris' => 'required|string|max:16',
    //         'ktp_sekretaris' => 'required|file|mimes:jpg,png,jpeg|max:2048',
    //         'nama_bendahara' => 'required|string|max:255',
    //         'nik_bendahara' => 'required|string|max:16',
    //         'ktp_bendahara' => 'required|file|mimes:jpg,png,jpeg|max:2048',
    //     ]);

    //     // Daftar field file yang akan diupload
    //     $fileFields = [
    //         'surat_permohonan',
    //         'surat_penetapan',
    //         'sk_susunan_kepengurusan',
    //         'plang_nama_sekretariat',
    //         'surat_keterangan_domisili',
    //         'ktp_ketua',
    //         'ktp_sekretaris',
    //         'ktp_bendahara',
    //     ];

    //     // Simpan file dan ambil path-nya
    //     foreach ($fileFields as $field) {
    //         $validatedData[$field] = $request->file($field)->storeAs('ormas_files', $request->file($field)->getClientOriginalName());
    //     }

    //     // Tambahkan user_id ke data yang akan disimpan
    //     $validatedData['user_id'] = auth()->id();

    //     // Hapus bidang_id dari data yang akan disimpan ke tabel ormas
    //     unset($validatedData['bidang_id']); // Pastikan bidang_id tidak disimpan ke tabel ormas

    //     // Simpan data Ormas ke dalam database
    //     $ormas = Ormas::create($validatedData);

    //     // Simpan relasi bidang
    //     $ormas->bidang()->attach($request->input('bidang_id')); // Menghubungkan bidang yang dipilih

    //     // Buat entri status dengan status 'pending'
    //     Status::create([
    //         'ormas_id' => $ormas->id,
    //         'status' => 'pending',
    //         'changed_by' => auth()->id(),
    //     ]);

    //     return redirect()->route('ormas.index')->with('success', 'Data Ormas berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_ormas' => 'required|string|max:255',
            'bentuk_organisasi_id' => 'required|exists:bentuk_organisasis,id',
            'bidang_id' => 'required|array', // Tetap di sini untuk validasi
            'bidang_id.*' => 'exists:bidangs,id',
            'surat_permohonan' => 'required|file|mimes:pdf|max:2048',
            'surat_penetapan' => 'required|file|mimes:pdf|max:2048',
            'sk_susunan_kepengurusan' => 'required|file|mimes:pdf|max:2048',
            'alamat_sekretariat' => 'required|string|max:255',
            'plang_nama_sekretariat' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'surat_keterangan_domisili' => 'required|file|mimes:pdf|max:2048',
            'kontak_person' => 'required|string|max:255',
            'nama_ketua' => 'required|string|max:255',
            'nik_ketua' => 'required|string|max:16',
            'ktp_ketua' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'nama_sekretaris' => 'required|string|max:255',
            'nik_sekretaris' => 'required|string|max:16',
            'ktp_sekretaris' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'nama_bendahara' => 'required|string|max:255',
            'nik_bendahara' => 'required|string|max:16',
            'ktp_bendahara' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Daftar field file yang akan diupload
        $fileFields = [
            'surat_permohonan',
            'surat_penetapan',
            'sk_susunan_kepengurusan',
            'plang_nama_sekretariat',
            'surat_keterangan_domisili',
            'ktp_ketua',
            'ktp_sekretaris',
            'ktp_bendahara',
        ];

        // Simpan file dan buat nama file yang unik
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $originalName = $request->file($field)->getClientOriginalName();
                // Tambahkan timestamp untuk membuat nama file menjadi unik
                $uniqueName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . time() . '.' . $request->file($field)->getClientOriginalExtension();
                // Simpan file dengan nama unik ke dalam folder 'ormas_files'
                $validatedData[$field] = $request->file($field)->storeAs('ormas_files', $uniqueName, 'public');
            }
        }

        // Tambahkan user_id ke data yang akan disimpan
        $validatedData['user_id'] = auth()->id();

        // Hapus bidang_id dari data yang akan disimpan ke tabel ormas (karena ini relasi many-to-many)
        unset($validatedData['bidang_id']);

        // Simpan data Ormas ke dalam database
        $ormas = Ormas::create($validatedData);

        // Simpan relasi bidang menggunakan attach (many-to-many)
        $ormas->bidang()->attach($request->input('bidang_id'));

        // Buat entri status dengan status 'pending'
        Status::create([
            'ormas_id' => $ormas->id,
            'status' => 'pending',
            'changed_by' => auth()->id(),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ormas.index')->with('success', 'Data Ormas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ormas $ormas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $ormas = Ormas::with(['bidang', 'bentukOrganisasi'])->findOrFail($id);
        $ormas = Ormas::with(['bidang', 'bentukOrganisasi'])->findOrFail($id);
        $bentukOrganisasis = bentuk_organisasi::all(); // Ambil semua bentuk organisasi
        $bidangs = bidang::all(); // Ambil semua bidang

        return view('ormas.edit', compact('ormas', 'bentukOrganisasis', 'bidangs'));
    }

    /**
     * Update the specified resource in storage.
     */


    // public function update(Request $request, Ormas $orma)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'nama_ormas' => 'required|string|max:255',
    //         'bentuk_organisasi_id' => 'required|exists:bentuk_organisasis,id',
    //         'bidang_id' => 'nullable|array',
    //         'bidang_id.*' => 'exists:bidangs,id',
    //         'surat_permohonan' => 'nullable|file|mimes:pdf|max:2048',
    //         'surat_penetapan' => 'nullable|file|mimes:pdf|max:2048',
    //         'sk_susunan_kepengurusan' => 'nullable|file|mimes:pdf|max:2048',
    //         'plang_nama_sekretariat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'surat_keterangan_domisili' => 'nullable|file|mimes:pdf|max:2048',
    //     ]);

    //     // Daftar field file yang akan diupload
    //     $fileFields = [
    //         'surat_permohonan',
    //         'surat_penetapan',
    //         'sk_susunan_kepengurusan',
    //         'plang_nama_sekretariat',
    //         'surat_keterangan_domisili',
    //     ];

    //     foreach ($fileFields as $field) {
    //         if ($request->hasFile($field)) {
    //             // Hapus file lama jika ada file baru
    //             if ($orma->$field) {
    //                 Storage::delete($orma->$field); // Menghapus file lama dari penyimpanan
    //             }
    //             // Simpan file dengan nama asli ke dalam folder 'ormas_files'
    //             $originalName = $request->file($field)->getClientOriginalName();
    //             $validated[$field] = $request->file($field)->storeAs('ormas_files', $originalName, 'public');
    //         } else {
    //             // Jika tidak ada file baru, gunakan file yang sudah ada
    //             $validated[$field] = $orma->$field; // Pertahankan file lama
    //         }
    //     }

    //     // Pertahankan user_id yang ada
    //     $validated['user_id'] = $orma->user_id;

    //     // Update bidang_id jika ada, gunakan sync untuk hubungan many-to-many
    //     if ($request->has('bidang_id')) {
    //         $orma->bidang()->sync($validated['bidang_id']);
    //     }

    //     // Update data di database, termasuk bentuk organisasi dan file yang diupload
    //     $orma->update([
    //         'nama_ormas' => $validated['nama_ormas'],
    //         'bentuk_organisasi_id' => $validated['bentuk_organisasi_id'],
    //         'user_id' => $validated['user_id'],
    //         // Update semua field file jika ada
    //         'surat_permohonan' => $validated['surat_permohonan'],
    //         'surat_penetapan' => $validated['surat_penetapan'],
    //         'sk_susunan_kepengurusan' => $validated['sk_susunan_kepengurusan'],
    //         'plang_nama_sekretariat' => $validated['plang_nama_sekretariat'],
    //         'surat_keterangan_domisili' => $validated['surat_keterangan_domisili'],
    //     ]);

    //     // Redirect ke halaman index dengan pesan sukses
    //     return redirect()->route('ormas.index')->with('success', 'Data Ormas berhasil diperbarui.');
    // }


    public function update(Request $request, Ormas $orma)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_ormas' => 'required|string|max:255',
            'bentuk_organisasi_id' => 'required|exists:bentuk_organisasis,id',
            'bidang_id' => 'nullable|array',
            'bidang_id.*' => 'exists:bidangs,id',
            'surat_permohonan' => 'nullable|file|mimes:pdf|max:2048',
            'surat_penetapan' => 'nullable|file|mimes:pdf|max:2048',
            'sk_susunan_kepengurusan' => 'nullable|file|mimes:pdf|max:2048',
            'plang_nama_sekretariat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'surat_keterangan_domisili' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Daftar field file yang akan diupload
        $fileFields = [
            'surat_permohonan',
            'surat_penetapan',
            'sk_susunan_kepengurusan',
            'plang_nama_sekretariat',
            'surat_keterangan_domisili',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Simpan file dengan nama unik menggunakan timestamp atau hash
                $originalName = $request->file($field)->getClientOriginalName();
                $uniqueName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . time() . '.' . $request->file($field)->getClientOriginalExtension();

                // Hapus file lama jika ada dan file baru diunggah
                if ($orma->$field && Storage::exists($orma->$field)) {
                    Storage::delete($orma->$field);
                }

                // Simpan file dengan nama unik ke dalam folder 'ormas_files'
                $validated[$field] = $request->file($field)->storeAs('ormas_files', $uniqueName, 'public');
            } else {
                // Jika tidak ada file baru, gunakan file yang sudah ada
                $validated[$field] = $orma->$field;
            }
        }

        // Pertahankan user_id yang ada
        $validated['user_id'] = $orma->user_id;

        // Update bidang_id jika ada, gunakan sync untuk hubungan many-to-many
        if ($request->has('bidang_id')) {
            $orma->bidang()->sync($validated['bidang_id']);
        }

        // Update data di database
        $orma->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ormas.index')->with('success', 'Data Ormas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Ormas $ormas)
    // {
    //     $ormas->delete();
    //     return redirect()->route('ormas.index')->with('success', 'Data ormas berhasil dihapus.');
    // }

    public function destroy($id)
    {
        $orma = Ormas::findOrFail($id);
        $orma->delete();

        return redirect()->route('ormas.index')->with('success', 'Data berhasil dihapus.');
    }
}
