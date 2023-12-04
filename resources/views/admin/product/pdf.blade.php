<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Rekap</title>

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
                <th>Name</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Jenis</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Berat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->image}}</td>
                <td>{{ $product->description}}</td>
                <td>{{ $product->type}}</td>
                <td>Rp. {{ $product->price}}</td>
                <td>{{ $product->stock}}</td>
                <td>{{ $product->weight}} g</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
