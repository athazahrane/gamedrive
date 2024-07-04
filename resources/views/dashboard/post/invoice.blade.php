@extends('dashboard.layouts.main')

@section('container')
    <h3 class="mt-4">Konfirmasi pembelian:</h3>
    <hr>

    <table class="shadow rounded">
        <thead>
            <tr>
                <th class="text-capitalize">no</th>
                <th class="text-capitalize">game</th>
                <th class="text-capitalize">email</th>
                <th class="text-capitalize">no telpon</th>
                <th class="text-capitalize">nama</th>
                <th class="text-capitalize">username</th>
                <th class="text-capitalize">option</th>
                <th class="text-capitalize">price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('payment_data')->options as $index => $option)
                <tr>
                    <td data-table="no">{{ $index + 1 }}</td>
                    <td data-table="game" class="text-capitalize">{{ session('payment_data')->name_game }}</td>
                    <td data-table="email">{{ session('payment_data')->email }}</td>
                    <td data-table="no telpon">{{ session('payment_data')->no_tlp }}</td>
                    <td data-table="nama">{{ session('payment_data')->name }}</td>
                    <td data-table="username">{{ session('payment_data')->username }}</td>
                    <td data-table="option">{{ $option['jenisTopUp'] }}</td>
                    <td data-table="price" class="text-danger">Rp {{ number_format($option['price'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-price d-flex flex-column align-items-end">
        <h6>Jumlah yang harus dibayar :</h6>
        <span id="totalPrice" class="text-danger d-flex justify-content-end">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
    </div>

    <div class="grp-btn d-flex gap-2">
        <form action="{{ route('post.confirmPayment') }}" method="post" id="confirm-form">
            @csrf
            <button type="submit" class="btn btn-success" style="max-width: max-content">Konfirmasi Pembelian</button>
        </form>
        <a href="{{ route('post.topup', ['post' => $post_id]) }}" class="btn btn-danger"
            style="max-width: max-content">Kembali</a>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>

    <script>
        document.getElementById('confirm-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = event.target;

            var iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.onload = function() {
                setTimeout(function() {
                    window.location.href = '{{ route('post.topup', ['post' => $post_id]) }}';
                }, 2000);
            };
            iframe.src = form.action;
            document.body.appendChild(iframe);

            form.submit();
        });
    </script>
@endsection
