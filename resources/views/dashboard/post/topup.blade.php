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
                    class="form-control @error('no_tlp') is-invalid @enderror" required value="{{ old('no_tlp') }}"
                    min="12">
                @error('no_tlp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}"
                    name="nama">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="{{ auth()->user()->username }}" readonly
                    disabled name="username">
            </div>

            {{-- Option Topup Game --}}
            <div id="optionContainer">
                <div class="mb-3 option-wrapper">
                    <label for="topupOption" class="form-label">Pilih Topup</label>
                    <select class="form-select @error('topupOption') is-invalid @enderror" id="topupOption"
                        name="topupOption[]" required>
                        <option value="" selected disabled>Pilih opsi topup</option>
                        @if (is_array($post->jenisTopUp) && is_array($post->price))
                            @foreach ($post->jenisTopUp as $index => $jenisTopUp)
                                <option value="{{ $jenisTopUp }}" data-price="{{ $post->price[$index] }}">
                                    {{ $jenisTopUp }} - Rp {{ number_format($post->price[$index], 0, ',', '.') }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('topupOption')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="add-btn d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-primary" id="addOptionBtn">+ tambah opsi topup</button>
                <button type="button" class="btn btn-danger" id="removeOptionBtn">hapus opsi</button>
            </div>

            <div class="end-card mt-5 d-flex justify-content-between">
                <div class="btn-grp">
                    <button type="submit" class="btn btn-success">Pesan Sekarang</button> {{-- ketika user sudah mengisi semua form dan form nya valid , saya ingin user akan diarahkan ke halaman invoive sambil membawa data yang user isi di halaman topup --}}
                    <a href="/my-dashboard/post" class="btn btn-danger text-decoration-none">Kembali</a>
                </div>

                <div class="total-price mb-3">
                    <h6>Jumlah yang harus dibayar :</h6>
                    <span id="totalPrice" class="text-danger d-flex justify-content-end">Rp 0</span>
                </div>
            </div>
        </form>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch(window.location.href)
                .then(response => {
                    if (response.headers.get('X-Success-Message')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.headers.get('X-Success-Message'),
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                    }
                });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addOptionBtn = document.getElementById('addOptionBtn');
            const removeOptionBtn = document.getElementById('removeOptionBtn');
            const totalPriceSpan = document.getElementById('totalPrice');
            let totalPrice = 0;

            function updateTotalPrice() {
                totalPrice = 0;
                const selects = document.querySelectorAll('select[name="topupOption[]"]');
                selects.forEach(select => {
                    const selectedOption = select.options[select.selectedIndex];
                    const price = parseFloat(selectedOption.getAttribute('data-price'));
                    if (!isNaN(price)) {
                        totalPrice += price;
                    }
                });
                totalPriceSpan.textContent = 'Rp ' + totalPrice.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }

            updateTotalPrice();

            addOptionBtn.addEventListener('click', function() {
                const originalSelect = document.querySelector('.option-wrapper');
                const newSelect = originalSelect.cloneNode(true);
                newSelect.querySelector('select').selectedIndex = 0;
                newSelect.classList.add('my-3');
                document.getElementById('optionContainer').appendChild(newSelect);
                updateTotalPrice();
            });

            removeOptionBtn.addEventListener('click', function() {
                const selectCount = document.querySelectorAll('select[name="topupOption[]"]').length;
                if (selectCount > 1) {
                    const selects = document.querySelectorAll('select[name="topupOption[]"]');
                    const lastSelect = selects[selects.length - 1];
                    lastSelect.parentNode.removeChild(lastSelect);
                    updateTotalPrice();
                }
            });

            document.addEventListener('change', function(e) {
                if (e.target && e.target.matches('select[name="topupOption[]"]')) {
                    updateTotalPrice();
                }
            });
        });
    </script>

@endsection
