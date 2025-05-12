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
                        @if ($order->status == 1 && $order->payment->status == 0)
                            <a href="{{ route('order.approve_payment', $order->invoice) }}" class="btn btn-primary btn-sm mb-3">Terima</a>
                        @endif
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
                                            <th scope="row">Alamat</th>
                                            @if ($order->condition == 1)
                                                <td>{{ $order->customer_address2 }}</td>
                                            @else
                                                <td>{{ $order->customer->address }} {{ $order->district->city->name }}, <br> {{ $order->district->name }} {{ $order->customer_postal_code }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td>{!! $order->status_label !!}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Kurir</th>
                                            @if ($order->condition == 1)
                                                <td>GOSEND</td>
                                            @else
                                                <td>{{ Str::upper($order->courier) }}</td>
                                            @endif
                                        </tr>
                                        @if ($order->status > 1)
                                            <tr>
                                                <th scope="row">Resi</th>
                                                <td>
                                                    @if ($order->status == 2)
                                                        <form action="{{ route('order.shipping') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                            <div class="input-group mb-3 w-auto">
                                                                <input type="text" name="tracking_number" class="form-control" placeholder="Masukkan Nomor Resi">
                                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                                                <p class="text-danger">{{ $errors->first('tracking_number') }}</p>
                                                            </div>
                                                        </form>
                                                    @else
                                                        {{ $order->tracking_number }}
                                                    @endif
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
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                        @if ($order->status != 0)
                                            <tr>
                                                <th scope="row" style="width: 400px;">Pengirim</th>
                                                <td>{{ $order->payment->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bank Tujuan</th>
                                                <td>{{ $order->payment->transfer_to }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Transfer</th>
                                                <td>{{ $order->payment->transfer_date }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jumlah Transfer</th>
                                                <td>IDR {{ number_format($order->payment->amount) }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bukti Pembayaran</th>
                                                <td><a href="{{ asset('storage/payments/' . $order->payment->proof) }}" target="_blank">Lihat</a></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>{!! $order->payment->status_label !!}</td>
                                            </tr>
                                            @if($order->return_count == 1)
                                                <tr>
                                                    <th scope="row">Return Status</th>
                                                    <td>{!! $order->return->status_label !!} </td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <th>Belum Melakukan Pembayaran</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
