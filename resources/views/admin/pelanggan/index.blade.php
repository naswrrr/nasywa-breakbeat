@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
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
                <li class="breadcrumb-item"><a href="#">Data Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="Daftar Pelanggan">Daftar Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Pelanggan</h1>
                <p class="mb-0">Kelola data pelanggan sistem.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-success"><i class="fas fa-plus me-1"></i> Tambah Pelanggan</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <form method="GET" action="{{ route('pelanggan.index') }}" onchange="this.form.submit()" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="gender" class="form-select">
                                        <option value="">All</option>
                                        <option value="Male" {{ request('gender')=='Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ request('gender')=='Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" id="exampleInputIconRight" value="{{request('search')}}" placeholder="Search" aria-label="Search">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        @if(request('search'))
                                        	<a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                        @endif
                                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0">First Name</th>
                                    <th class="border-0">Last Name</th>
                                    <th class="border-0">Birthday</th>
                                    <th class="border-0">Gender</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Phone</th>
                                    <th class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @forelse ($dataPelanggan as $pelanggan)
                                <tr>
                                    <td>{{ ($dataPelanggan->currentPage() - 1) * $dataPelanggan->perPage() + $loop->iteration }}</td>
                                    <td>{{ $pelanggan->first_name }}</td>
                                    <td>{{ $pelanggan->last_name }}</td>
                                    <td>{{ $pelanggan->birthday }}</td>
                                    <td>{{ $pelanggan->gender }}</td>
                                    <td>{{ $pelanggan->email }}</td>
                                    <td>{{ $pelanggan->phone }}</td>
                                    <td>
                                        <a href="{{ route('pelanggan.edit', $pelanggan->pelanggan_id) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('pelanggan.destroy', $pelanggan->pelanggan_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-3x mb-3"></i>
                                            <p>Belum ada data pelanggan</p>
                                            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah Pelanggan Pertama</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $dataPelanggan->links('pagination::simple-bootstrap-5') }}
                    </div>
                    <div class="text-muted small">
                        Showing {{ $dataPelanggan->firstItem() }} to {{ $dataPelanggan->lastItem() }} of {{ $dataPelanggan->total() }} entries
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
