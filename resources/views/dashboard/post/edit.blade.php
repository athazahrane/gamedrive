@extends('dashboard.layouts.main')

@section('container')
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3 class="mt-3 mb-4">{{ $title }}</h3>
        
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Gambar Jasa</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFileMultiple" name="image" multiple>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid mt-2" style="max-width: 200px;">
        </div>
        
        <div class="mb-3">
            <label for="title-card" class="form-label">Title Jasa</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title-card" name="title" value="{{ $post->title }}" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Input untuk jenis topup dan harga --}}
        <div class="mb-3 input-option">
            @foreach ($post->jenisTopUp as $index => $jenisTopUp)
                <div class="option-group">
                    <label for="topup_option" class="form-label">Isi jenis topup</label>
                    <input type="text" name="jenisTopUp[]" class="form-control mb-2" required placeholder="Nama jenis topup, contoh 5 diamond" value="{{ old('jenisTopUp.' . $index, $jenisTopUp) }}">
                    <div class="input-group mb-2">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="price[]" class="form-control price-input" required placeholder="Masukkan nominal harga" value="{{ old('price.' . $index, $post->price[$index]) }}">
                    </div>
                    @if ($loop->last)
                        <hr>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Tombol untuk menambahkan opsi topup baru --}}
        <button type="button" class="btn btn-primary mb-3" id="addOptionBtn">Tambah option</button>
        <button type="button" class="btn btn-danger mb-3" id="removeOptionBtn">Hapus option</button>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Jasa</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" name="description" rows="3">{{ old('description', $post->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Jasa Topup Game</button>
        <a href="{{ route('post.index') }}" class="btn btn-danger">Kembali</a>
    </form>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addOptionBtn = document.getElementById('addOptionBtn');
            const removeOptionBtn = document.getElementById('removeOptionBtn');
            const inputOption = document.querySelector('.input-option');
        
            addOptionBtn.addEventListener('click', function() {
                const newOptionGroup = document.createElement('div');
                newOptionGroup.classList.add('mb-3', 'option-group');
                newOptionGroup.innerHTML = `
                    <label for="topup_option" class="form-label">Isi jenis topup</label>
                    <input type="text" name="jenisTopUp[]" class="form-control mb-2" required
                        placeholder="Nama jenis topup, contoh 5 diamond" value="">
                    <div class="input-group mb-2">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="price[]" class="form-control price-input" required
                            placeholder="Masukkan nominal harga" value="">
                    </div>
                    <hr>
                `;
                inputOption.appendChild(newOptionGroup);
            });
        
            removeOptionBtn.addEventListener('click', function() {
                const optionGroups = document.querySelectorAll('.option-group');
                if (optionGroups.length > 1) {
                    optionGroups[optionGroups.length - 1].remove();
                }
            });
        });
    </script>
@endsection