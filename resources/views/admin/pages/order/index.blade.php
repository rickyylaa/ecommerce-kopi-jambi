@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Pesanan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                            <li class="breadcrumb-item active">Pesanan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pesanan</h4>
                        <div class="table-responsive">
                            <form method="GET" action="{{ route('order.index') }}" class="mb-3">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <select name="status" class="form-select">
                                                <option value="">Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Lunas</option>
                                                <option value="2">Diproses</option>
                                                <option value="3">Dikirim</option>
                                                <option value="4">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="input-group w-auto">
                                                <input type="text" name="q" class="form-control" placeholder="Cari Pesanan" value="{{ request()->q }}">
                                                <button type="submit" class="btn btn-light">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-centered align-middle" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Informasi Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($order) > 0)
                                        @foreach ($order as $row)
                                            <tr>
                                                <td></td>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                <td>{{ $row->id }}</td>
                                                <td>
                                                    <ul class="list-unstyled product-desc-list">
                                                        <li>Nama: {{ $row->customer_name }}</li>
                                                        <li>Telp: {{ $row->customer_phone }}</li>
                                                        @if ($row->condition == 1)
                                                            <li>Alamat: {{ $row->customer_address2 }}</li>
                                                        @else
                                                            <li>Alamat: {{ $row->customer_address }} {{ $row->district->city->name }}, <br> {{ $row->district->name }} {{ $row->customer_postal_code }}</li>
                                                        @endif
                                                    </ul>
                                                </td>
                                                <td>{{ $row->created_at->format('d M Y') }}</td>
                                                <td>IDR {{ number_format($row->total) }}</td>
                                                <td>
                                                    @if ($row->return_count == 1)
                                                        <div class="badge badge-soft-primary font-size-12">Dikembalikan</div>
                                                    @else
                                                        {!! $row->status_label !!}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>
                                                        <form method="POST" action="{{ route('order.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('order.view', $row->invoice) }}" class="text-primary me-2"><i class="mdi mdi-eye font-size-18"></i></a>
                                                            @if ($row->return_count == 1)
                                                                <a href="{{ route('order.return', $row->invoice) }}" class="text-primary"><i class="mdi mdi-keyboard-return font-size-18"></i></a>
                                                            @endif
                                                            <button type="submit" class="text-danger" style="background: none; border: none;"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <div class="col-12">
                                                    <div class="text-center mt-4">
                                                        <span class="d-block ml-auto text-body-emphasis fw-bold">Anda tidak memiliki data di tabel ini</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                </tbody>
                            </table>
                        </div>
                        @if (count($order) > 0)
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <span class="text-bold">Menampilkan {{ $order->firstItem() }} hingga {{ $order->lastItem() }} dari {{ $order->total() }} entri</span>
                            {!! $order->links('pagination::bootstrap-4') !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
