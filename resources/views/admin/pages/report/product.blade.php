@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Laporan Produk</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                            <li class="breadcrumb-item active">Laporan Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Laporan Produk</h4>
                        <div class="table-responsive">
                            @role('admin')
                                <form action="{{ url('admin/report/product') }}" method="get">
                                    <div class="d-flex mb-3 align-items-center">
                                        <div>
                                            <input type="text" id="created_at" name="date" class="form-control" placeholder="Date">
                                        </div>
                                        <div class="ms-auto flex-shrink-0">
                                            <button class="btn btn-secondary" type="submit">Filter</button>
                                            <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                                        </div>
                                    </div>
                                </form>
                            @endrole
                            @role('owner')
                                <form action="{{ url('owner/report/product') }}" method="get">
                                    <div class="d-flex mb-3 align-items-center">
                                        <div>
                                            <input type="text" id="created_at" name="date" class="form-control" placeholder="Date">
                                        </div>
                                        <div class="ms-auto flex-shrink-0">
                                            <button class="btn btn-secondary" type="submit">Filter</button>
                                            <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                                        </div>
                                    </div>
                                </form>
                            @endrole
                            <table class="table table-centered align-middle" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Detail</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($orders) > 0)
                                        @foreach ($orders as $row)
                                            <tr>
                                                <td></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/products/'. $row->product->image) }}" alt="product-img" class="avatar-lg">
                                                </td>
                                                <td>{{ $row->product->title }}</td>
                                                <td>{{ $row->qty }} item</td>
                                                <td>IDR {{ number_format($row->price) }}</td>
                                                <td>IDR {{ number_format($row->qty * $row->price) }}</td>
                                                <td>{{ $row->created_at->format('d M Y') }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection

@role('admin')
    @section('script')
        <script>
            $(document).ready(function() {
                let start = moment().startOf('month')
                let end = moment().endOf('month')

                $('#exportpdf').attr('href', '/admin/report/product/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

                $('#created_at').daterangepicker({
                    startDate: start,
                    endDate: end
                }, function(first, last) {
                    $('#exportpdf').attr('href', '/admin/report/product/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
                })
            })
        </script>
    @endsection
@endrole
@role('owner')
    @section('script')
        <script>
            $(document).ready(function() {
                let start = moment().startOf('month')
                let end = moment().endOf('month')

                $('#exportpdf').attr('href', '/owner/report/product/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

                $('#created_at').daterangepicker({
                    startDate: start,
                    endDate: end
                }, function(first, last) {
                    $('#exportpdf').attr('href', '/owner/report/product/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
                })
            })
        </script>
    @endsection
@endrole
