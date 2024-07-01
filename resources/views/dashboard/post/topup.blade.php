@extends('dashboard.layouts.main')

@section('container')
    <div class="card mt-4 mb-3">
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top object-fit-cover" style="max-height: 300px;"
            alt="{{ $post->title }}">
        <div class="card-body">
            <h5 class="card-title text-capitalize">{{ $post->title }}</h5>
            <p class="card-text"><small class="text-body-secondary">Last updated
                    {{ $post->updated_at->diffForHumans() }}</small></p>
            <p class="card-text">{{ $post->description }}</p>
        </div>
        <form class="p-3" style="" action="{{ route('post.formTopup', $post->id) }}" method="post">
            @csrf
            <h2 class="text-capitalize">Form Pembayaran</h2>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    value="{{ auth()->user()->email }}" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="name_game" class="form-label">Game</label>
                <input type="text" class="form-control @error('name_game') is-invalid @enderror" id="name_game"
                    value="{{ $post->title }}" name="name_game" readonly required>
                @error('name_game')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tlp">No Telpon</label>
                <input type="number" name="no_tlp" id="no-tlp"
                    class="form-control @error('no_tlp') is-invalid @enderror" required value="{{ old('no_tlp') }}" min="12">
                @error('no_tlp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}" name="nama">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="{{ auth()->user()->username }}" readonly
                    disabled name="username">
            </div>

            {{-- Option Topup Game --}}
            <div class="mb-3">
                <label for="topupOption" class="form-label">Pilih Topup</label>
                <select class="form-select @error('option') is-valid @enderror" id="topupOption" name="topupOption" required
                    value="{{ old('option') }}">
                    <option value="" class="mb-5" selected disabled>Pilih opsi topup</option>
                    @if (is_array($post->jenisTopUp) && is_array($post->price))
                        @foreach ($post->jenisTopUp as $index => $jenisTopUp)
                            <option value="{{ $jenisTopUp }}">
                                {{ $jenisTopUp }} - Rp {{ number_format($post->price[$index], 0, ',', '.') }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('option')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Pesan Sekarang</button>

            <a href="/my-dashboard/post" class="btn btn-danger text-decoration-none">Kembali</a>
        </form>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>
@endsection