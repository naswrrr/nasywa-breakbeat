@extends('layouts.admin')
{{-- sesuaikan layout kamu --}}

@section('content')
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4">Tambah Pelanggan</h2>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">

            <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" class="form-control" name="telepon">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Foto / KTP / Dokumen lainnya</label>
                        <input type="file" class="form-control" name="files[]" multiple>
                        <small class="text-muted">Bisa upload lebih dari 1 file</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-2">
                    Simpan
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
