@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Data Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
        </ol>
    </nav>

    <div class="card border-0 shadow">
        <div class="card-body">

            <h3 class="mb-3">{{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</h3>

            {{-- FOTO --}}
            <div class="mb-4">
                <h5>Foto Pelanggan</h5>
                <div class="row">
                    @php
                        $photos = json_decode($pelanggan->photos, true);
                    @endphp

                    @if ($photos && count($photos))
                        @foreach ($photos as $photo)
                            <div class="col-md-3 col-6 mb-3">
                                <img src="{{ asset('storage/' . $photo) }}"
                                     class="img-fluid rounded shadow"
                                     style="object-fit: cover; width:100%; height:180px;">
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Tidak ada foto.</p>
                    @endif
                </div>
            </div>

            <h5 class="mb-3">Informasi</h5>
            <table class="table table-bordered">
                <tr>
                    <th>First Name</th>
                    <td>{{ $pelanggan->first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $pelanggan->last_name }}</td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td>{{ $pelanggan->birthday }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $pelanggan->gender }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pelanggan->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $pelanggan->phone }}</td>
                </tr>
            </table>

            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
