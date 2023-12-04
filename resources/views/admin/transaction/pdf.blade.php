<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Rekap</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgb(49, 230, 70)
        }

    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Nama Customer</th>
                <th>Product</th>
                <th>Jumlah/Kg</th>
                <th>Harga</th>
                <th>Ongkir</th>
                <th>Service</th>
                <th>Total Bayar</th>
                <th>Resi</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            @foreach($user->payments as $payment)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    <!-- Loop untuk PaymentItem -->
                    <ul>
                        @foreach($payment->items as $item)
                        <li>{{ $item->product->name }}</li>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        @endforeach
                    </ul>
                    <!-- Akhir loop untuk PaymentItem -->
                </td>
                <td>
                    <!-- Loop untuk PaymentItem -->
                    <ul>
                        @foreach($payment->items as $item)
                        <li>{{ $item->quantity }}</li>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        @endforeach
                    </ul>
                    <!-- Akhir loop untuk PaymentItem -->
                </td>
                <td>
                    <!-- Loop untuk PaymentItem -->
                    <ul>
                        @foreach($payment->items as $item)
                        <li>Rp. {{ number_format($item->price, 0, ',', '.') }}</li>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        @endforeach
                    </ul>
                    <!-- Akhir loop untuk PaymentItem -->
                </td>
                <td>Rp. {{ number_format($payment->ongkir, 0, ',', '.') }}</td>
                <td>{{ $payment->service }}</td>
                <td>Rp. {{ $payment->gross_amount }}</td>
                <td>{{ $payment->resi }}</td>
                <td>{{ $payment->status }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

</body>

</html>
