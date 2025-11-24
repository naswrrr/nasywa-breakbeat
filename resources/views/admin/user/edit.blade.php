@extends('layouts.admin.app')

@section('content')
<main class="content">
    <div class="container py-4">

        {{-- 📌 BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h3 class="h4">Edit User</h3>
                <p class="mb-0">Ubah data user sistem.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- KOLOM KIRI --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Password Baru</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Kosongkan jika tidak diubah">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Kosongkan jika tidak diubah">
                                        </div>
                                    </div>
                                </div>

                                {{-- KOLOM KANAN --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Profil</label>
                                        <input type="file" name="profile_picture" class="form-control"
                                            accept="image/*">
                                        @error('profile_picture')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        {{-- PREVIEW FOTO SAAT INI --}}
                                        <div class="mt-3">
                                            <label class="form-label">Foto Saat Ini:</label>
                                            <div class="text-center">
                                                <img
                                                    src="{{ $user->profile_picture
                                                            ? asset('storage/uploads/profile/'.$user->profile_picture)
                                                            : asset('assets-admin/img/profile.jpg') }}"
                                                    width="150"
                                                    height="150"
                                                    class="img-thumbnail rounded-circle object-fit-cover"
                                                    alt="{{ $user->name }}"
                                                    id="profile-preview">
                                            </div>
                                            @if($user->profile_picture)
                                                <div class="mt-2 text-center">
                                                    <small class="text-muted">{{ $user->profile_picture }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TOMBOL ACTION --}}
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

{{-- SCRIPT UNTUK PREVIEW IMAGE --}}
<script>
    // Preview image sebelum upload
    document.querySelector('input[name="profile_picture"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
