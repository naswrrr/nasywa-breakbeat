@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
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
                <li class="breadcrumb-item"><a href="#">Data Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Users</li>
            </ol>
        </nav>

        {{-- 📌 TITLE --}}
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Users</h1>
                <p class="mb-0">Kelola data users sistem.</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i> Tambah User
                </a>
            </div>
        </div>
    </div>

    {{-- 🔍 FILTER & SEARCH --}}
    <form method="GET" action="{{ route('user.index') }}" class="mb-4">
        <div class="row">
            {{-- FILTER VERIFIKASI --}}
            <div class="col-md-2">
                <select name="email_verified_at" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="yes" {{ request('email_verified_at') == 'yes' ? 'selected' : '' }}>Verified</option>
                    <option value="no" {{ request('email_verified_at') == 'no' ? 'selected' : '' }}>Not Verified</option>
                </select>
            </div>

            {{-- SEARCH --}}
            <div class="col-md-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        value="{{ request('search') }}" placeholder="Cari nama atau email">

                    <button type="submit" class="input-group-text">
                        <i class="fas fa-search"></i>
                    </button>

                    @if (request('search'))
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Clear</a>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    {{-- ALERT SUCCESS --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0">Nama</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Dibuat</th>
                                    <th class="border-0 rounded-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($dataUser->currentPage() - 1) * $dataUser->perPage() }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus user ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-3x mb-3"></i>
                                            <p>Belum ada user</p>
                                            <a href="{{ route('user.create') }}" class="btn btn-primary">
                                                Tambah User Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $dataUser->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
