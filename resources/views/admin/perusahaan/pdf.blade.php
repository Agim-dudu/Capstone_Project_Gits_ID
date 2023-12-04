<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perusahaan Rekap</title>

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
                <th>Nama</th>
                <th>Province</th>
                <th>City</th>
                <th>Code Pos</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Url</th>
                <th>Karyawan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perusahaans as $perusahaan)
            <tr>
                <td>{{ $perusahaan->nama_perusahaan }}</td>                                      
                <td>{{ $perusahaan->province }}</td>
                <td>{{ $perusahaan->city }}</td>
                <td>{{ $perusahaan->postal_code }}</td>
                <td>{{ $perusahaan->email }}</td>
                <td>{{ $perusahaan->phone }}</td>
                <td>{{ $perusahaan->url }}</td>
                <td>{{ $perusahaan->jumlah_karyawan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
