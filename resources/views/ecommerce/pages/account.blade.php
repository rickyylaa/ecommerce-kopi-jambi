@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Akun</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">Akun</h2>
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
                        <h3 class="fs-5 mb-6">Detail Informasi</h3>
                        <div class="fs-6">
                            @if ($customer->address == NULL)
                                <p class="mb-2">{{ Str::ucfirst($customer->first_name) }} {{ Str::ucfirst($customer->last_name) }}</p>
                                <p class="mb-2">{{ Str::ucfirst($customer->country) }}</p>
                            @else
                                <p class="mb-2">{{ Str::ucfirst($customer->first_name) }} {{ Str::ucfirst($customer->last_name) }}</p>
                                <p class="mb-2">{{ Str::ucfirst($customer->country) }}</p>
                                <p class="mb-2">{{ Str::ucfirst($customer->address) }} {{ $customer->district->city->name }}, <br> {{ $customer->district->name }}, {{ $customer->postal_code }}</p>
                                <p class="mb-2">{{ $customer->email }}</p>
                                <p class="mb-2">{{ $customer->phone }}</p>
                            @endif
                        </div>
                        <a href="{{ route('customer.setting') }}" class="text-decoration-none border-bottom border-currentColor fw-semibold fs-6 me-7">Edit</a>
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
                        <div class="fs-6">
                            <p class="mb-2">Belum Dibayar : IDR {{ number_format($orders[0]->pending) }}</p>
                            <p class="mb-2">Pesanan Baru : {{ number_format($orders[0]->newOrder) }} Pesanan</p>
                            <p class="mb-2">Dalam Proses : {{ $orders[0]->processOrder }} Order</p>
                            <p class="mb-2">Diterima : {{ $orders[0]->shipping }} Order</p>
                            <p class="mb-2">Pesanan Selesai : {{ $orders[0]->completeOrder }} Order</p>
                            <p class="mb-2">Pesanan Dikembalikan : {{ $orders[0]->returnOrder }} Order</p>
                        </div>
                        <a href="{{ route('customer.orders') }}" class="text-decoration-none border-bottom border-currentColor fw-semibold fs-6 me-7">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
