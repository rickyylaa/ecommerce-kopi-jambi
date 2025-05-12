@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a title="Product" href="{{ route('front.checkout') }}">Check Out</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Invoice</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">INVOICE</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ps-lg-18 ps-xl-21 mt-13 mt-lg-0">
                <div class="d-flex align-items-start mb-11 me-15">
                    <div class="d-none">
                        <svg class="icon fs-2">
                            <use xlink:href="#"></use>
                        </svg>
                    </div>
                    <div>
                        <h3 class="fs-5 mb-6">Informasi Anda</h3>
                        <div class="fs-6">
                            <p class="mb-2">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                            @if ($order->condition == 1)
                            <p class="mb-2">{{ $order->customer->address2 }}</p>
                            @else
                            <p class="mb-2">{{ $order->customer->address }} {{ $order->district->city->name }}, <br> {{ $order->district->name }} {{ $order->customer_postal_code }}</p>
                            @endif
                            <p class="mb-2">{{ $order->customer->email }}</p>
                            <p class="mb-2">{{ $order->customer->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-18 ps-xl-21 mt-13 mt-lg-0">
                <div class="d-flex align-items-start mb-11 me-15">
                    <div class="d-none">
                        <svg class="icon fs-2">
                            <use xlink:href="#"></use>
                        </svg>
                    </div>
                    <div>
                        <h3 class="fs-5 mb-6">Pesanan Anda</h3>
                        <div class="fs-6 mb-10">
                            <p class="mb-2">Invoice : {{ $order->invoice }}</p>
                            <p class="mb-5">Tanggal : {{ $order->created_at->format('d M Y') }}</p>
                            <p class="mb-0">Produk : </p>
                            <p class="mb-0">
                                @foreach ($order->details as $row)
                                    <div class="d-flex">
                                        - {{ $row->product->title }}
                                    </div>
                                @endforeach
                            </p>
                            <p class="mb-2">Subtotal : IDR {{ number_format($order->subtotal) }}</p>
                            @if ($order->condition == 1)
                            @else
                            <p class="mb-2">Ongkir : IDR {{ number_format($order->cost) }}</p>
                            @endif
                            <p class="mb-2">Total : IDR {{ number_format($order->total) }}</p>
                        </div>
                        <div class="d-flex">
                            <a href="{{ route('front.index') }}" class="text-decoration-none border-bottom border-currentColor fw-semibold fs-6 me-7">Kembali</a>
                            <a href="{{ route('customer.view_order', $order->invoice) }}" class="text-decoration-none border-bottom border-currentColor fw-semibold fs-6">Konfirmasi Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
