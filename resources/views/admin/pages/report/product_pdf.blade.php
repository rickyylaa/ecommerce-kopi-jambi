<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <h5>Laporan Product Periode ({{ $date[0] }} - {{ $date[1] }})</h5>
    <hr>
    <table width="100%" class="table-hover table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse ($orders as $row)
                <tr>
                    <td><strong>{{ $row->product->title }}</strong></td>
                    <td>Rp {{ number_format($row->price) }}</td>
                    <td>{{ $row->qty }} Item</td>
                    <td>Rp {{ number_format($row->qty * $row->price) }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                </tr>

                @php $total += $row->total @endphp
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table><br>
    <div>
        <span class="mt-30">Pemilik</span><br>
        <img src="" alt=""><br><br>
        <span>Aldino Ramadhani</span>
    </div>
</body>
</html>
