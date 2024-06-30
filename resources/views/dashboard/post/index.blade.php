@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Kami Menyediakan Top Up:
        </h1>
    </div>

    <div class="btn-admin-group">
        <a href="/my-dashboard/post/create" class="text-decoration-none d-block ms-auto mb-3" style="max-width: max-content">
            <button class="btn btn-secondary">+ Buat data jasa topup baru</button>
        </a>
    </div>

    {{-- delete data --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    {{-- crate data --}}
    @if (session('successCreateData'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('successCreateData') }}',
            });
        </script>
    @endif

    {{-- update data --}}
    @if (session('successUpdateData'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('successUpdateData') }}',
            });
        </script>
    @endif

    <div class="jasa d-flex justify-content-evenly gap-3 align-items-center flex-wrap">
        @foreach ($posts as $post)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="{{ route('post.topup', $post->id) }}" class="btn btn-primary">Topup sekarang</a>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus data</button>
                    </form>
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning my-2">Edit data</a>
                </div>
            </div>
        @endforeach
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>
@endsection
