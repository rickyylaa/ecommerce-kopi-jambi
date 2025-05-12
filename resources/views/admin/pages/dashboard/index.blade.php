@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')
@section('active-home-dashboard', 'active')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Pelanggan</p>
                                        <h4 class="mb-0">{{ $customers->count() }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-group-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Pendapatan</p>
                                        <h4 class="mb-0">IDR {{ number_format($order[0]->turnover) }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-hand-coin-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Penjualan</p>
                                        <h4 class="mb-0">{{ $orders->count() }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-shopping-bag-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Produk</p>
                                        <h4 class="mb-0">{{ $products->count() }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-cup-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
