@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Detail Pesanan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                            <li class="breadcrumb-item active">Detail Pesanan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 400px;">Nama</th>
                                            <td>{{ $order->customer_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Telp</th>
                                            <td>{{ $order->customer_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alasan Return</th>
                                            <td>{{ $order->return->reason }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Rekening Pengembalian Dana</th>
                                            <td>{{ $order->return->refund_transfer }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td>{!! $order->return->status_label !!}</td>
                                        </tr>
                                        @if ($order->return->status == 0)
                                            <tr>
                                                <th scope="row">Resi</th>
                                                <td>
                                                    <form action="{{ route('order.approve_return') }}" onsubmit="return confirm('Kamu Yakin ?');" method="post">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <div class="input-group mb-3 w-auto">
                                                            <select name="status" class="form-control" required>
                                                                <option value="">Pilih</option>
                                                                <option value="1">Terima</option>
                                                                <option value="2">Tolak</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4>Foto Barang Return</h4>
                            <img src="{{ asset('storage/returns/' . $order->return->photo) }}" class="img-responsive" height="200" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
