@extends('layouts.admin.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
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

                    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Nama Depan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                           id="first_name" name="first_name"
                                           value="{{ old('first_name', $pelanggan->first_name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Nama Belakang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           id="last_name" name="last_name"
                                           value="{{ old('last_name', $pelanggan->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birthday">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                           id="birthday" name="birthday"
                                           value="{{ old('birthday', $pelanggan->birthday) }}" required>
                                    @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control @error('gender') is-invalid @enderror"
                                            id="gender" name="gender" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('gender', $pelanggan->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender', $pelanggan->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email"
                                           value="{{ old('email', $pelanggan->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone"
                                           value="{{ old('phone', $pelanggan->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Data
                                </button>
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
