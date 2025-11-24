@extends('layouts.admin.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Data Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Pelanggan</h1>
                <p class="mb-0">Edit data pelanggan sistem.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ======================= --}}
                        {{-- DATA FORM NORMAL --}}
                        {{-- ======================= --}}

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="first_name">Nama Depan</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ old('first_name', $pelanggan->first_name) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Nama Belakang</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ old('last_name', $pelanggan->last_name) }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="birthday">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="birthday"
                                    value="{{ old('birthday', $pelanggan->birthday) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" name="gender">
                                    <option value="">Pilih</option>
                                    <option value="L" {{ $pelanggan->gender == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ $pelanggan->gender == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $pelanggan->email) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Telepon</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('phone', $pelanggan->phone) }}">
                            </div>
                        </div>

                        {{-- ======================= --}}
                        {{-- MULTIPLE FILE UPLOAD --}}
                        {{-- ======================= --}}

                        <div class="mb-4">
                            <label for="photos" class="form-label">Upload Foto (Bisa Banyak)</label>
                            <input type="file" name="photos[]" class="form-control" multiple>
                            <small class="text-muted">Biarkan kosong jika tidak menambah foto.</small>
                        </div>

                        {{-- ======================= --}}
                        {{-- PREVIEW FOTO LAMA --}}
                        {{-- ======================= --}}

                        @php
                            // PERBAIKAN: Cek tipe data sebelum decode
                            if (is_array($pelanggan->photos)) {
                                $oldPhotos = $pelanggan->photos;
                            } else {
                                $oldPhotos = json_decode($pelanggan->photos ?? '[]', true);
                            }
                        @endphp

                        @if (!empty($oldPhotos) && count($oldPhotos) > 0)
                            <div class="mb-4">
                                <label class="fw-bold">Foto Sebelumnya:</label>
                                <div class="row">
                                    @foreach ($oldPhotos as $photo)
                                        <div class="col-md-3 col-6 mb-3 text-center">
                                            <img src="{{ asset('storage/' . $photo) }}" class="img-fluid rounded shadow"
                                                style="height:120px; object-fit:cover;">
                                            <div class="mt-1">
                                                <small class="text-muted">{{ basename($photo) }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
