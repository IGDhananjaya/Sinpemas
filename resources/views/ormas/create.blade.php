@extends('layouts.penggunalayout')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Tambah Ormas</h1>
        <form action="{{ route('ormas.store') }}" method="POST" enctype="multipart/form-data" id="form-ormas">
            @csrf

            <!-- Stepper -->
            <div class="flex justify-between mb-6">
                <div class="flex-1">
                    <div class="w-full bg-gray-200 h-2">
                        <div id="step1" class="bg-blue-500 h-2" style="width: 0;"></div>
                    </div>
                    <p class="text-center mt-2">Informasi Umum</p>
                </div>
                <div class="flex-1">
                    <div class="w-full bg-gray-200 h-2">
                        <div id="step2" class="bg-gray-200 h-2" style="width: 0;"></div>
                    </div>
                    <p class="text-center mt-2">Data Pengurus</p>
                </div>
                <div class="flex-1">
                    <div class="w-full bg-gray-200 h-2">
                        <div id="step3" class="bg-gray-200 h-2" style="width: 0;"></div>
                    </div>
                    <p class="text-center mt-2">Informasi Kontak</p>
                </div>
            </div>

            <!-- Informasi Umum -->
            <div id="section1" class="bg-white shadow-md rounded mb-4 p-4">
                <h5 class="text-xl font-semibold mb-4">Informasi Umum</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_ormas" class="block text-sm font-medium text-gray-700">Nama Ormas</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            id="nama_ormas" name="nama_ormas" value="{{ old('nama_ormas') }}" required>
                    </div>
                    <div>
                        <label for="bentuk_organisasi" class="block text-sm font-medium text-gray-700">Bentuk
                            Organisasi</label>
                        <select
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            id="bentuk_organisasi" name="bentuk_organisasi_id" required>
                            <option value="">Pilih Bentuk Organisasi</option>
                            @foreach ($bentukOrganisasis as $bentuk)
                                <option value="{{ $bentuk->id }}"
                                    {{ old('bentuk_organisasi_id') == $bentuk->id ? 'selected' : '' }}>
                                    {{ $bentuk->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Bidang</label>
                    <div class="flex flex-wrap">
                        @foreach ($bidangs as $bidang)
                            <div class="form-check mr-4 mb-2">
                                <input class="form-check-input" type="checkbox" name="bidang_id[]"
                                    value="{{ $bidang->id }}" id="bidang_{{ $bidang->id }}"
                                    {{ in_array($bidang->id, old('bidang_id', [])) ? 'checked' : '' }}>
                                <label class="form-check-label text-sm" for="bidang_{{ $bidang->id }}">
                                    {{ $bidang->nama }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row mb-4">
                    @foreach ([
            'surat_permohonan' => 'Surat Permohonan Pencatatan Keberadaan Ormas (PDF)',
            'surat_penetapan' => 'Surat Penetapan (PDF)',
            'sk_susunan_kepengurusan' => 'SK Susunan Kepengurusan (PDF)',
            'plang_nama_sekretariat' => 'Plang Nama Sekretariat',
            'surat_keterangan_domisili' => 'Surat Keterangan Domisili (PDF)',
        ] as $field => $label)
                        <div class="col-md-6 mb-3">
                            <label for="{{ $field }}">{{ $label }}</label>
                            <input type="file" class="form-control-file" id="{{ $field }}"
                                name="{{ $field }}"
                                {{ in_array($field, ['plang_nama_sekretariat']) ? 'accept=image/*' : 'required' }}>
                            <button type="button" class="btn btn-link" id="toggle-preview-{{ $field }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                </svg>
                            </button>
                            <div id="preview-{{ $field }}" class="preview-container" style="display: none;">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" class="bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed"
                        onclick="prevStep(2)" disabled>Kembali</button>
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onclick="nextStep(1)">Selanjutnya</button>
                </div>
            </div>

            <!-- Data Pengurus -->
            <div id="section2" class="bg-white shadow-md rounded mb-4 p-4 hidden">
                <h5 class="text-xl font-semibold mb-4">Data Pengurus</h5>
                @php
                    $pengurus = ['Ketua', 'Sekretaris', 'Bendahara'];
                @endphp

                @foreach ($pengurus as $posisi)
                    <h6 class="font-semibold mt-4">{{ $posisi }}</h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_{{ strtolower($posisi) }}"
                                class="block text-sm font-medium text-gray-700">Nama {{ $posisi }}</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="nama_{{ strtolower($posisi) }}" name="nama_{{ strtolower($posisi) }}"
                                value="{{ old('nama_' . strtolower($posisi)) }}" required>
                        </div>
                        <div>
                            <label for="nik_{{ strtolower($posisi) }}" class="block text-sm font-medium text-gray-700">NIK
                                {{ $posisi }}</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="nik_{{ strtolower($posisi) }}" name="nik_{{ strtolower($posisi) }}"
                                value="{{ old('nik_' . strtolower($posisi)) }}" required>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="ktp_{{ strtolower($posisi) }}">KTP {{ $posisi }}</label>
                                <input type="file" class="form-control-file" id="ktp_{{ strtolower($posisi) }}"
                                    name="ktp_{{ strtolower($posisi) }}" accept="image/*" required>
                                <button type="button" class="btn btn-link"
                                    id="toggle-preview-ktp_{{ strtolower($posisi) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                    </svg>
                                </button>
                                <div id="preview-ktp_{{ strtolower($posisi) }}" class="preview-container"
                                    style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-between mt-4">
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                        onclick="prevStep(2)">Kembali</button>
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onclick="nextStep(2)">Selanjutnya</button>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div id="section3" class="bg-white shadow-md rounded mb-4 p-4 hidden">
                <h5 class="text-xl font-semibold mb-4">Informasi Kontak</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="alamat_sekretariat" class="block text-sm font-medium text-gray-700">Alamat
                            Sekretariat</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            id="alamat_sekretariat" name="alamat_sekretariat" value="{{ old('alamat_sekretariat') }}"
                            required>
                    </div>
                    <div>
                        <label for="kontak_person" class="block text-sm font-medium text-gray-700">Kontak Person</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            id="kontak_person" name="kontak_person" value="{{ old('kontak_person') }}" required>
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                        onclick="prevStep(3)">Kembali</button>
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('[id^="section"]').forEach((section, index) => {
                section.classList.toggle('hidden', index !== step - 1);
            });
            document.querySelectorAll('[id^="step"]').forEach((bar, index) => {
                bar.style.width = (index === step - 1) ? '100%' : '0';
                bar.classList.toggle('bg-blue-500', index === step - 1);
                bar.classList.toggle('bg-gray-200', index !== step - 1);
            });
        }

        function nextStep(step) {
            if (step < 3) {
                currentStep = step + 1;
                showStep(currentStep);
            }
        }

        function prevStep(step) {
            if (step > 1) {
                currentStep = step - 1;
                showStep(currentStep);
            }
        }

        document.addEventListener('DOMContentLoaded', () => showStep(currentStep));
    </script>
@endsection

@section('scripts')
    <script>
        function handleFilePreview(inputId, previewId, toggleId) {
            const preview = document.getElementById(previewId);
            const toggleButton = document.getElementById(toggleId);
            let isPreviewVisible = false;

            document.getElementById(inputId).addEventListener('change', function() {
                const file = this.files[0];
                preview.innerHTML = '';

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const fileType = file.type;

                        if (fileType.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '80px'; // Set max width for preview
                            img.style.maxHeight = '100px'; // Set max height for preview
                            img.style.border = '1px solid #ccc'; // Optional styling
                            img.style.marginLeft = '10px'; // Optional spacing
                            preview.appendChild(img);
                        } else if (fileType === 'application/pdf') {
                            const pdfEmbed = document.createElement('embed');
                            pdfEmbed.src = e.target.result;
                            pdfEmbed.style.width = '100%';
                            pdfEmbed.style.height = '200px'; // Set height for PDF preview
                            pdfEmbed.type = 'application/pdf';
                            preview.appendChild(pdfEmbed);
                        } else {
                            preview.innerHTML = '<p>File tidak didukung.</p>';
                        }
                    };

                    reader.readAsDataURL(file);
                }
            });

            toggleButton.addEventListener('click', function() {
                isPreviewVisible = !isPreviewVisible;
                preview.style.display = isPreviewVisible ? 'block' : 'none';
                toggleButton.innerHTML = isPreviewVisible ?
                    `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>` :
                    `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                    </svg>`;
            });
        }

        // Initialize file previews
        handleFilePreview('plang_nama_sekretariat', 'preview-plang_nama_sekretariat',
            'toggle-preview-plang_nama_sekretariat');
        handleFilePreview('ktp_ketua', 'preview-ktp_ketua', 'toggle-preview-ktp_ketua');
        handleFilePreview('ktp_sekretaris', 'preview-ktp_sekretaris', 'toggle-preview-ktp_sekretaris');
        handleFilePreview('ktp_bendahara', 'preview-ktp_bendahara', 'toggle-preview-ktp_bendahara');
        handleFilePreview('surat_permohonan', 'preview-surat_permohonan', 'toggle-preview-surat_permohonan');
        handleFilePreview('surat_penetapan', 'preview-surat_penetapan', 'toggle-preview-surat_penetapan');
        handleFilePreview('sk_susunan_kepengurusan', 'preview-sk_susunan_kepengurusan',
            'toggle-preview-sk_susunan_kepengurusan');
        handleFilePreview('surat_keterangan_domisili', 'preview-surat_keterangan_domisili',
            'toggle-preview-surat_keterangan_domisili');
    </script>
@endsection
