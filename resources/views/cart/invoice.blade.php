<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
    <style type="text/css" media="print">
        /* Gaya CSS untuk struk */
        @page {
            size: 100mm 120mm;
            margin:5mm;
        }
        body {
            font-family: monospace;
            padding: 10px;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 10px;
        }
        .header {
            text-align: center;
        }
        .store-info {
            margin-top: 10px;
            border-bottom: 2px dashed black; 
        }
        .transaction-details {
            margin-top: 10px;
            border-top: 2px dashed black;
            border-bottom: 2px dashed black;
        }
        .items {
            margin-top: 10px;
        }
        .total {
            margin-top: 10px;
            text-align: right;
            border-top: 2px dashed black;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <h2>CANDARIA</h2>
            <h3>SMKN 2 PURWAKARTA</h3>
        </div>
        <div class="store-info">
            <p>Jl. Jend. Ahmad Yani No.44, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114</p>
            
        </div>
        <div class="transaction-details">
            <p>Invoice No. : {{'SO-' . $orderX->created_at->format('Y') . '/' . $orderX->created_at->format('dm') . '/' . str_pad($orderX->id, 4, '0', STR_PAD_LEFT)}}</p>
            <p>Kasir : {{ $orderX->user->name }}</p>
        </div>
        <div class="items">
            <table width="100%">
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ number_format($order->product->price, 0)}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ number_format($order->product->price * $order->quantity, 0) }}</td>
                </tr>
                @endforeach
                <!-- Tambahkan baris lain sesuai dengan produk yang dibeli -->
            </table>
        </div>
        <div class="total">
            <h3>Total   : {{ config('settings.currency_symbol') }} {{ number_format($total, 0) }}</h3>
            <h4>Tunai   : {{ config('settings.currency_symbol') }} {{$orderX->formattedReceivedAmount()}}</h4>
            <h4>Kembali : {{config('settings.currency_symbol')}} {{number_format(abs($orderX->total() - $orderX->receivedAmount()), 2)}}</h4>
        </div>
        <div class="footer">
            <p>TERIMA KASIH, SELAMAT BELANJA KEMBALI</p>
            <P>===CANDARIA===</P>
        </div>
    </div>
</body>
</html>
