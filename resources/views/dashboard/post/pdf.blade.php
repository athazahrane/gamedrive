<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
    h4 {
        margin: 0;
    }

    .w-full {
        width: 100%;
    }

    .w-half {
        width: 50%;
    }

    .margin-top {
        margin-top: 1.25rem;
    }

    .footer {
        font-size: 0.875rem;
        padding: 1rem;
        background-color: rgb(241 245 249);
    }

    table {
        width: 100%;
        border-spacing: 0;
    }

    table.products {
        font-size: 0.875rem;
    }

    table.products tr {
        background-color: rgb(96 165 250);
    }

    table.products th {
        color: #ffffff;
        padding: 0.5rem;
    }

    table tr.items {
        background-color: rgb(241 245 249);
    }

    table tr.items td {
        padding: 0.5rem;
        text-align: center;
    }

    .total {
        text-align: right;
        margin-top: 1rem;
        font-size: 0.875rem;
    }
</style>

<body>
    <table class="w-full">
        <tr>
            {{-- <td class="w-half">
                <img src="{{ asset('images/web-icon.jpg') }}" width="200" />
            </td> --}}
            {{-- <td class="w-half">
                <h2>Invoice ID: 834847473</h2>
            </td> --}}
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>To:</h4>
                    </div>
                    <div>{{ $payment->name }}</div>
                    <div>{{ $payment->no_tlp }}</div>
                </td>
                <td class="w-half">
                    <div>
                        <h4>From:</h4>
                    </div>
                    <div>Gamedrive</div>
                    <div>Website para gamers</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th>No</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <tr class="items">
                <td>
                    1   {{-- ganti supaya angka nya bertambah jika banyak opsi yang user buat --}}
                </td>
                <td>
                    {{ $payment->option }}
                </td>
                <td style="color: #DC3545;">
                    Rp 5.000 - {{-- ganti dengan harga per produk --}}
                </td>
            </tr>
        </table>
    </div>

    <div class="total" style="color: #DC3545;">
        Total: Rp 5.000 - {{-- jumlahkan semua harga produk yang ada --}}
    </div>

    <div class="footer margin-top">
        <div>Terimakasih telah melakukan topup di website kami ^^</div>
        <div>&copy; gamedrive</div>
    </div>
</body>

</html>