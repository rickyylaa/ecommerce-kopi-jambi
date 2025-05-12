@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a title="Akun" href="{{ route('customer.account') }}">Akun</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Pesanan Anda</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">PESANAN ANDA</h2>
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
                        <h3 class="fs-5 mb-6">Informasi Pesanan</h3>
                        <div class="fs-6">
                            <p class="mb-2">Invoice : {{ $order->invoice }}</p>
                            <p class="mb-0">Produk : </p>
                            <p class="mb-0">
                                <div class="d-flex">
                                    @foreach ($order->details as $row)
                                        - {{ $row->product->title }}
                                    @endforeach
                                </div>
                            </p>
                            <p class="mb-2">Subtotal : IDR {{ number_format($order->subtotal) }}</p>
                            @if ($order->condition == 1)
                            @else
                            <p class="mb-2">Ongkir : IDR {{ number_format($order->cost) }}</p>
                            @endif
                            <p class="mb-2">Total : IDR {{ number_format($order->total) }}</p>
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
                        <h3 class="fs-5 mb-6">Informasi Pembayaran</h3>
                        <div class="fs-6">
                            @if ($order->payment)
                                <p class="mb-2">Pengirim : {{ $order->payment->name }}</p>
                                <p class="mb-2">Bank Tujuan : {{ $order->payment->transfer_to }}</p>
                                <p class="mb-2">Tanggal Transfer : {{ $order->payment->transfer_date }}</p>
                                <p class="mb-2">Jumlah Transfer : IDR {{ number_format($order->payment->amount) }}</p>
                                <p class="mb-2">Bukti Pembayaran : <a href="{{ asset('storage/payments/'. $order->payment->proof) }}" target="_blank"d class="text-primary">View</a></p>
                            @else
                                <p class="mb-2">Belum ada data pembayaran</p>
                                <p class="mb-2"><a href="{{ route('customer.paymentForm', $order->invoice) }}" class="text-primary small">Konfirmasi Pembayaran</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
