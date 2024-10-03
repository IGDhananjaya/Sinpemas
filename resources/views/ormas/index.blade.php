@extends('layouts.penggunalayout')

@section('content')
    <div class="container">
        <!-- Judul dan Tombol Tambah Ormas -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="text-2xl font-semibold text-gray-700">Daftar Ormas</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('ormas.create') }}" class="btn btn-primary">Tambah Ormas</a>
            </div>
        </div>

        <!-- Tampilkan pesan sukses atau error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Daftar Ormas -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ormas</th>
                        <th>Bentuk Organisasi</th>
                        <th>Kontak Person</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ormas as $index => $orma)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $orma->nama_ormas }}</td>
                            <td>{{ $orma->bentukOrganisasi->nama }}</td>
                            <td>{{ $orma->kontak_person }}</td>
                            <td>
                                @if ($orma->is_submitted)
                                    <span class="badge badge-success">Sudah Submit</span>
                                @else
                                    <span class="badge badge-warning">Belum Submit</span>
                                @endif
                            </td>
                            <td>
                                <!-- Tombol Aksi -->
                                @if (!$orma->is_submitted)
                                    <a href="{{ route('ormas.edit', $orma->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form id="delete-form-{{ $orma->id }}"
                                        action="{{ route('ormas.destroy', $orma->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $orma->id }})">Hapus</button>
                                    </form>
                                    <a href="{{ route('ormas.resume', $orma->id) }}" class="btn btn-sm btn-info">Lihat
                                        Resume</a>
                                @else
                                    <a href="{{ route('ormas.resume', $orma->id) }}" class="btn btn-sm btn-primary">Lihat
                                        Resume</a>
                                    <span class="text-muted">Tidak bisa diedit/hapus</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $ormas->links() }}
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(ormasId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini tidak dapat dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + ormasId).submit();
                }
            });
        }
    </script>
@endsection
