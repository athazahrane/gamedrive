@extends('dashboard.layouts.main')

@section('container')
    <h3 class="mt-4">Komfirmasi pembelian : </h3>
    <hr>

    <div class="card-invoice">
        @foreach ($payments as $payment)
            <h4>Email: {{ $payment->email }}</h4>
            <h4>Nomor Telepon: {{ $payment->no_tlp }}</h4>
            <h4>Nama: {{ $payment->name }}</h4>
            <h4>Username: {{ $payment->username }}</h4>
            <h4>Opsi: {{ $payment->option }}</h4>
        @endforeach
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="390"></canvas>
@endsection
