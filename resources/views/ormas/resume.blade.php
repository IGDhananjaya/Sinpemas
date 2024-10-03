@extends('layouts.penggunalayout')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">Resume Pengisian Ormas</h1>

        <!-- Informasi Umum -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Informasi Umum</h5>
            </div>
            <div class="card-body preview" id="info">
                <p><strong>Nama Ormas:</strong> {{ $ormas->nama_ormas }}</p>
                <p><strong>Bentuk Organisasi:</strong> {{ $ormas->bentukOrganisasi->nama }}</p>

                <!-- Tambahan: Bidang Organisasi -->
                <p><strong>Bidang Organisasi:</strong>
                    @if ($ormas->bidang->isNotEmpty())
                        {{ $ormas->bidang->pluck('nama')->implode(', ') }}
                    @else
                        <span>Tidak ada bidang yang terkait.</span>
                    @endif
                </p>

                <!-- Preview Surat Permohonan (PDF) -->
                <p><strong>Surat Permohonan:</strong>
                    @if ($ormas->surat_permohonan)
                        {{-- <a href="{{ asset('storage/' . $ormas->surat_permohonan) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewSuratPermohonan" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewSuratPermohonan" class="preview-container" style="display:none;">
                            <iframe src="{{ asset('storage/' . $ormas->surat_permohonan) }}" width="50%"
                                height="500px"></iframe>
                        </div>
                    @endif
                </p>

                <!-- Preview Surat Penetapan (PDF) -->
                <p><strong>Surat Penetapan:</strong>
                    @if ($ormas->surat_penetapan)
                        {{-- <a href="{{ asset('storage/' . $ormas->surat_penetapan) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewSuratPenetapan" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewSuratPenetapan" class="preview-container" style="display:none;">
                            <iframe src="{{ asset('storage/' . $ormas->surat_penetapan) }}" width="50%"
                                height="500px"></iframe>
                        </div>
                    @endif
                </p>

                <!-- Preview SK Kepengurusan (PDF) -->
                <p><strong>SK Kepengurusan:</strong>
                    @if ($ormas->sk_susunan_kepengurusan)
                        {{-- <a href="{{ asset('storage/' . $ormas->sk_susunan_kepengurusan) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewSkKepengurusan" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewSkKepengurusan" class="preview-container" style="display:none;">
                            <iframe src="{{ asset('storage/' . $ormas->sk_susunan_kepengurusan) }}" width="50%"
                                height="500px"></iframe>
                        </div>
                    @endif
                </p>

                <!-- Preview Surat Keterangan Domisili (PDF) -->
                <p><strong>Surat Keterangan Domisili:</strong>
                    @if ($ormas->surat_keterangan_domisili)
                        {{-- <a href="{{ asset('storage/' . $ormas->surat_keterangan_domisili) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewSuratDomisili" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewSuratDomisili" class="preview-container" style="display:none;">
                            <iframe src="{{ asset('storage/' . $ormas->surat_keterangan_domisili) }}" width="50%"
                                height="500px"></iframe>
                        </div>
                    @endif
                </p>

                <!-- Preview Plang Nama Sekretariat (Gambar) -->
                <p><strong>Plang Nama Sekretariat:</strong>
                    @if ($ormas->plang_nama_sekretariat)
                        {{-- <a href="{{ asset('storage/' . $ormas->plang_nama_sekretariat) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewPlangNama" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewPlangNama" class="preview-container" style="display:none;">
                            <img src="{{ asset('storage/' . $ormas->plang_nama_sekretariat) }}" alt="Preview Plang Nama"
                                class="img-fluid" style="max-width: 30%; height: auto;">
                        </div>
                    @endif
                </p>
            </div>
        </div>

        <!-- Data Pengurus -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Data Pengurus</h5>
            </div>
            <div class="card-body preview" id="dataPengurus">
                <p><strong>Nama Ketua:</strong> {{ $ormas->nama_ketua }}</p>
                <p><strong>NIK Ketua:</strong> {{ $ormas->nik_ketua }}</p>
                <p><strong>KTP Ketua (Gambar):</strong>
                    @if ($ormas->ktp_ketua)
                        {{-- <a href="{{ asset('storage/' . $ormas->ktp_ketua) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewKtpKetua" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewKtpKetua" class="preview-container" style="display:none;">
                            <img src="{{ asset('storage/' . $ormas->ktp_ketua) }}" alt="Preview KTP Ketua"
                                class="img-fluid" style="max-width: 30%; height: auto;">
                        </div>
                    @endif
                </p>

                <p><strong>Nama Sekretaris:</strong> {{ $ormas->nama_sekretaris }}</p>
                <p><strong>NIK Sekretaris:</strong> {{ $ormas->nik_sekretaris }}</p>
                <p><strong>KTP Sekretaris (Gambar):</strong>
                    @if ($ormas->ktp_sekretaris)
                        {{-- <a href="{{ asset('storage/' . $ormas->ktp_sekretaris) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewKtpSekretaris" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewKtpSekretaris" class="preview-container" style="display:none;">
                            <img src="{{ asset('storage/' . $ormas->ktp_sekretaris) }}" alt="Preview KTP Sekretaris"
                                class="img-fluid" style="max-width: 30%; height: auto;">
                        </div>
                    @endif
                </p>

                <p><strong>Nama Bendahara:</strong> {{ $ormas->nama_bendahara }}</p>
                <p><strong>NIK Bendahara:</strong> {{ $ormas->nik_bendahara }}</p>
                <p><strong>KTP Bendahara (Gambar):</strong>
                    @if ($ormas->ktp_bendahara)
                        {{-- <a href="{{ asset('storage/' . $ormas->ktp_bendahara) }}" target="_blank">Lihat File</a> --}}
                        <button id="togglePreviewKtpBendahara" class="btn btn-secondary">
                            Tampilkan Pratinjau
                        </button>
                        <div id="previewKtpBendahara" class="preview-container" style="display:none;">
                            <img src="{{ asset('storage/' . $ormas->ktp_bendahara) }}" alt="Preview KTP Bendahara"
                                class="img-fluid" style="max-width: 30%; height: auto;">
                        </div>
                    @endif
                </p>
            </div>
        </div>

        <!-- Informasi Kontak -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Informasi Kontak</h5>
            </div>
            <div class="card-body preview" id="filePendukung">
                <p><strong>Alamat Sekretariat:</strong> {{ $ormas->alamat_sekretariat }}</p>
                <p><strong>Kontak Person:</strong> {{ $ormas->kontak_person }}</p>
            </div>
        </div>

        <!-- Tombol Submit ke Admin -->
        @if (!$ormas->is_submitted)
            <div class="d-flex justify-content-between">
                <a href="{{ route('ormas.index') }}" class="btn btn-primary">Kembali</a>
                <a href="{{ route('ormas.edit', $ormas->id) }}" class="btn btn-warning">Edit Data</a>
                <form id="submitForm" action="{{ route('ormas.submitToAdmin', $ormas->id) }}" method="POST">
                    @csrf
                    <button type="button" id="submitButton" class="btn btn-success">Submit ke Admin</button>
                </form>
            </div>
        @else
            <span class="text-muted">Data sudah di-submit.</span>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle preview functions
        function togglePreview(buttonId, previewId) {
            document.getElementById(buttonId).addEventListener('click', function() {
                const preview = document.getElementById(previewId);
                if (preview.style.display === 'none') {
                    preview.style.display = 'block';
                    this.textContent = 'Sembunyikan Pratinjau';
                } else {
                    preview.style.display = 'none';
                    this.textContent = 'Tampilkan Pratinjau';
                }
            });
        }

        // Initialize all preview toggles
        togglePreview('togglePreviewSuratPermohonan', 'previewSuratPermohonan');
        togglePreview('togglePreviewSuratPenetapan', 'previewSuratPenetapan');
        togglePreview('togglePreviewSkKepengurusan', 'previewSkKepengurusan');
        togglePreview('togglePreviewSuratDomisili', 'previewSuratDomisili');
        togglePreview('togglePreviewPlangNama', 'previewPlangNama');
        togglePreview('togglePreviewKtpKetua', 'previewKtpKetua');
        togglePreview('togglePreviewKtpSekretaris', 'previewKtpSekretaris');
        togglePreview('togglePreviewKtpBendahara', 'previewKtpBendahara');

        // Handle form submission with confirmation
        document.getElementById('submitButton').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda tidak akan bisa mengubah data setelah ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, submit!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    Swal.fire({
                        title: "Submitted!",
                        text: "Data Anda telah disubmit.",
                        icon: "success"
                    }).then(() => {
                        document.getElementById('submitForm').submit();
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
