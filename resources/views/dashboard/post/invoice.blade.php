@extends('dashboard.layouts.main')

@section('container')
    <h3 class="mt-4">Konfirmasi pembelian:</h3>
    <hr>

    <div class="card-invoice d-flex flex-column gap-4 p-4 shadow mt-4 rounded">
        <span class="fw-bold">Game: <p class="fw-normal d-inline">{{ $payment->name_game }}</p></span>
        <span class="fw-bold">Email: <p class="fw-normal d-inline">{{ $payment->email }}</p></span>
        <span class="fw-bold">No Telpon: <p class="fw-normal d-inline">{{ $payment->no_tlp }}</p></span>
        <span class="fw-bold">Nama: <p class="fw-normal d-inline">{{ $payment->name }}</p></span>
        <span class="fw-bold">Username: <p class="fw-normal d-inline">{{ $payment->username }}</p></span>
        <span class="fw-bold">Option: <p class="fw-normal d-inline">{{ $payment->option }}</p></span>
        <div class="grp-btn d-flex gap-2">
            <form action="{{ route('post.confirmPayment') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success" style="max-width: max-content">Konfirmasi Pembayaran</button>
            </form>
            <a href="/my-dashboard/post/{post}/topup" class="btn btn-danger" style="max-width: max-content">Kembali</a>
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>
@endsection