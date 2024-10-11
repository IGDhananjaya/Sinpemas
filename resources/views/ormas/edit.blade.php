@extends('layouts.penggunalayout')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Ormas</h1>
        <form action="{{ route('ormas.update', $ormas->id) }}" method="POST" enctype="multipart/form-data" id="form-ormas">
            @csrf
            @method('PUT')

            <!-- Stepper -->
            <div class="flex justify-between mb-6">
                <div class="flex-1">
                    <div class="w-full bg-gray-200 h-2">
                        <div id="step1" class="bg-blue-500 h-2" style="width: 100%;"></div>
                    </div>
                    <p class="text-center mt-2">Informasi Umum</p>
                </div>
                <div class="flex-1">
                    <div class="w-full bg-gray-200 h-2">
                        <div id="step2" class="bg-gray-200 h-2"></div>
                    </div>
                    <p class="text-center mt-2">Data Pengurus</p>
                </div>
                <div class="flex-1">
                    <div class="w-full bg-gray-200 h-2">
                        <div id="step3" class="bg-gray-200 h-2"></div>
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
                            id="nama_ormas" name="nama_ormas" value="{{ old('nama_ormas', $ormas->nama_ormas) }}" required>
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
                                    {{ old('bentuk_organisasi_id', $ormas->bentuk_organisasi_id) == $bentuk->id ? 'selected' : '' }}>
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
                            <div class="form-check custom-checkbox mr-4 mb-2">
                                <input class="form-check-input" type="checkbox" name="bidang_id[]"
                                    value="{{ $bidang->id }}" id="bidang_{{ $bidang->id }}"
                                    {{ in_array($bidang->id, old('bidang_id', $ormas->bidang->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="bidang_{{ $bidang->id }}">
                                    {{ $bidang->nama }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- <div class="row mb-4">
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
                                accept="{{ in_array($field, ['plang_nama_sekretariat']) ? 'image/*' : 'application/pdf' }}">

                            @if ($ormas->$field)
                                <p>File saat ini: <a href="{{ asset('storage/' . $ormas->$field) }}"
                                        target="_blank">{{ basename($ormas->$field) }}</a></p>

                                <div id="existing-preview-{{ $field }}" class="preview-container">
                                    @if (Str::endsWith($ormas->$field, ['.jpg', '.jpeg', '.png']))
                                        <img src="{{ asset('storage/' . $ormas->$field) }}"
                                            style="max-width: 80px; max-height: 100px;"
                                            alt="{{ basename($ormas->$field) }}">
                                    @elseif (Str::endsWith($ormas->$field, '.pdf'))
                                        <embed src="{{ asset('storage/' . $ormas->$field) }}" type="application/pdf"
                                            style="width: 100%; height: 200px;" />
                                    @endif
                                </div>
                                <button type="button" class="btn btn-link"
                                    id="toggle-existing-preview-{{ $field }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                    </svg>
                                </button>
                            @endif

                            <div id="preview-{{ $field }}" class="preview-container"></div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" class="bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed"
                        onclick="prevStep(2)" disabled>Kembali</button>
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onclick="nextStep(1)">Selanjutnya</button>
                </div>
            </div> --}}

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
                                accept="{{ in_array($field, ['plang_nama_sekretariat']) ? 'image/*' : 'application/pdf' }}">

                            @if ($ormas->$field)
                                <p>File saat ini: <a href="{{ asset('storage/' . $ormas->$field) }}"
                                        target="_blank">{{ basename($ormas->$field) }}</a></p>

                                <div id="existing-preview-{{ $field }}" class="preview-container">
                                    @if (Str::endsWith($ormas->$field, ['.jpg', '.jpeg', '.png']))
                                        <img src="{{ asset('storage/' . $ormas->$field) }}"
                                            style="max-width: 80px; max-height: 100px;"
                                            alt="{{ basename($ormas->$field) }}">
                                    @elseif (Str::endsWith($ormas->$field, '.pdf'))
                                        <embed src="{{ asset('storage/' . $ormas->$field) }}" type="application/pdf"
                                            style="width: 100%; height: 200px;" />
                                    @endif
                                </div>
                                <button type="button" class="btn btn-link"
                                    id="toggle-existing-preview-{{ $field }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                    </svg>
                                </button>
                            @endif

                            <div id="preview-{{ $field }}" class="preview-container"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Buttons -->
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
                                value="{{ old('nama_' . strtolower($posisi), $ormas->{'nama_' . strtolower($posisi)}) }}"
                                required>
                        </div>
                        <div>
                            <label for="nik_{{ strtolower($posisi) }}"
                                class="block text-sm font-medium text-gray-700">NIK {{ $posisi }}</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="nik_{{ strtolower($posisi) }}" name="nik_{{ strtolower($posisi) }}"
                                value="{{ old('nik_' . strtolower($posisi), $ormas->{'nik_' . strtolower($posisi)}) }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ktp_{{ strtolower($posisi) }}">KTP {{ $posisi }}</label>
                            <input type="file" class="form-control-file" id="ktp_{{ strtolower($posisi) }}"
                                name="ktp_{{ strtolower($posisi) }}" accept="image/*">

                            @if ($ormas->{'ktp_' . strtolower($posisi)})
                                <p>File saat ini: <a
                                        href="{{ asset('storage/' . $ormas->{'ktp_' . strtolower($posisi)}) }}"
                                        target="_blank">ktp_{{ strtolower($posisi) }}</a></p>

                                <div id="existing-preview-ktp_{{ strtolower($posisi) }}" class="preview-container">
                                    <img src="{{ asset('storage/' . $ormas->{'ktp_' . strtolower($posisi)}) }}"
                                        style="max-width: 80px; max-height: 100px;" alt="KTP {{ $posisi }}">
                                </div>
                                <button type="button" class="btn btn-link"
                                    id="toggle-existing-preview-ktp_{{ strtolower($posisi) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                    </svg>
                                </button>
                            @endif

                            <!-- Tempat untuk menampilkan preview file baru -->
                            <div id="preview-ktp_{{ strtolower($posisi) }}" class="preview-container"></div>
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
                            id="alamat_sekretariat" name="alamat_sekretariat"
                            value="{{ old('alamat_sekretariat', $ormas->alamat_sekretariat) }}" required>
                    </div>
                    <div>
                        <label for="kontak_person" class="block text-sm font-medium text-gray-700">Kontak Person</label>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            id="kontak_person" name="kontak_person"
                            value="{{ old('kontak_person', $ormas->kontak_person) }}" required>
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                        onclick="prevStep(3)">Kembali</button>
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan
                    </button>
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
        function togglePreview(previewId, toggleId) {
            const preview = document.getElementById(previewId);
            const toggleButton = document.getElementById(toggleId);
            let isPreviewVisible = true;

            toggleButton.addEventListener('click', function() {
                isPreviewVisible = !isPreviewVisible;
                preview.style.display = isPreviewVisible ? 'block' : 'none';
                toggleButton.innerHTML = isPreviewVisible ?
                    `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5 8 5.5 8 5.5-3 5.5-8 5.5S0 8 0 8z"/>
                    </svg>` :
                    `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                        <path d="M13.359 10.729a7.718 7.718 0 0 0 1.227-2.729S13 2.5 8 2.5 2 8 2 8a7.718 7.718 0 0 0 1.227 2.729l-1.364 1.364 1.415 1.415 1.364-1.364A7.719 7.719 0 0 0 8 13.5c5 0 8-5.5 8-5.5a7.718 7.718 0 0 0-1.227-2.729l1.364-1.364-1.415-1.415-1.364 1.364A7.719 7.719 0 0 0 8 13.5zM8 11.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z"/>
                    </svg>`;
            });
        }

        // Apply toggle function for each file preview
        @foreach (['surat_permohonan', 'surat_penetapan', 'sk_susunan_kepengurusan', 'plang_nama_sekretariat', 'surat_keterangan_domisili'] as $field)
            togglePreview('existing-preview-{{ $field }}', 'toggle-existing-preview-{{ $field }}');
        @endforeach

        @foreach (['ketua', 'sekretaris', 'bendahara'] as $posisi)
            togglePreview('existing-preview-ktp_{{ strtolower($posisi) }}',
                'toggle-existing-preview-ktp_{{ strtolower($posisi) }}');
        @endforeach
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ([
        'surat_permohonan' => 'Surat Permohonan Pencatatan Keberadaan Ormas (PDF)',
        'surat_penetapan' => 'Surat Penetapan (PDF)',
        'sk_susunan_kepengurusan' => 'SK Susunan Kepengurusan (PDF)',
        'plang_nama_sekretariat' => 'Plang Nama Sekretariat',
        'surat_keterangan_domisili' => 'Surat Keterangan Domisili (PDF)',
    ] as $field => $label)
                document.getElementById('{{ $field }}').addEventListener('change', function(event) {
                    const fileInput = event.target;
                    const file = fileInput.files[0];
                    const previewContainer = document.getElementById('preview-{{ $field }}');
                    previewContainer.innerHTML = ''; // Clear previous preview

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            if (file.type.startsWith('image/')) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '80px';
                                img.style.maxHeight = '100px';
                                previewContainer.appendChild(img);
                            } else if (file.type === 'application/pdf') {
                                const embed = document.createElement('embed');
                                embed.src = e.target.result;
                                embed.type = 'application/pdf';
                                embed.style.width = '100%';
                                embed.style.height = '200px';
                                previewContainer.appendChild(embed);
                            }
                        };

                        reader.readAsDataURL(file);
                    }
                });
            @endforeach
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach (['surat_permohonan', 'surat_penetapan', 'sk_susunan_kepengurusan', 'plang_nama_sekretariat', 'surat_keterangan_domisili'] as $field)
                document.getElementById('toggle-existing-preview-{{ $field }}').addEventListener('click',
                    function() {
                        const preview = document.getElementById('existing-preview-{{ $field }}');
                        if (preview.style.display === 'none') {
                            preview.style.display = 'block';
                        } else {
                            preview.style.display = 'none';
                        }
                    });
            @endforeach
        });
    </script>

    <script>
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(event) {
                const field = this.id;
                const previewContainer = document.getElementById(`preview-${field}`);
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.innerHTML = '';

                        // Menampilkan gambar jika file adalah gambar
                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '80px';
                            img.style.maxHeight = '100px';
                            previewContainer.appendChild(img);
                        }

                        // Menampilkan preview PDF jika file adalah PDF
                        if (file.type === 'application/pdf') {
                            const embed = document.createElement('embed');
                            embed.src = e.target.result;
                            embed.type = 'application/pdf';
                            embed.style.width = '100%';
                            embed.style.height = '200px';
                            previewContainer.appendChild(embed);
                        }
                    };

                    reader.readAsDataURL(file);
                } else {
                    previewContainer.innerHTML = '';
                }
            });
        });
    </script>
@endsection
