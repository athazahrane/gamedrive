@extends('dashboard.layouts.main')

@section('container')
    
    <h3 class="text-capitalize mt-3">buat akun petugas</h3>
    <hr>

    <form action="/my-dashboard/admin/create-petugas" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Petugas</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="btn-grp d-flex gap-2">
            <button type="submit" class="btn btn-success">Buat akun</button>
            <a href="/my-dashboard/admin" class="btn btn-danger">Kembali</a>
        </div>
    </form>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>
@endsection