@extends('Admin.layout.Admin.app')

@section('content')
    <!-- Start -->
    <main class="content">
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">

            </div>
        </nav>



        <div class="container py-4">
            <div class="d-flex justify-content-between mb-3">
                <h3>Daftar Users</h3>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if ($dataUser->count())
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                                    <div class="row">

                                        <!-- FILTER VERIFIED -->
                                        <div class="col-md-2">
                                            <select name="email_verified_at" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="">All</option>
                                                <option value="yes"
                                                    {{ request('email_verified_at') == 'yes' ? 'selected' : '' }}>
                                                    Verified
                                                </option>
                                                <option value="no"
                                                    {{ request('email_verified_at') == 'no' ? 'selected' : '' }}>
                                                    Not Verified
                                                </option>
                                            </select>
                                        </div>

                                        <!-- SEARCH INPUT -->
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder="Search name or email">

                                                <button type="submit" class="input-group-text">
                                                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>

                                                @if (request('search'))
                                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                        class="btn btn-outline-secondary ml-3" id="clear-search">
                                                        Clear
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $user)
                                        <tr>
                                            <td>{{ $loop->iteration + ($dataUser->currentPage() - 1) * $dataUser->perPage() }}
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Hapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <div class="mt-3">
                                    {{ $dataUser->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </table>
                        </div>

                        {{ $dataUser->links() }}
                    @else
                        <p class="mb-0">Belum ada user.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <!-- End -->
@endsection
