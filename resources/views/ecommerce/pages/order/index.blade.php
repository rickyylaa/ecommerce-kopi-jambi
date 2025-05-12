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
                        <h3 class="fs-5 mb-6">Detail Pesanan</h3>
                        <div class="fs-6">
                        @if (count($orders) > 0)
                            @foreach ($orders as $row)
                                <div class="d-grid justify-content-start align-items-center mb-0">
                                    @foreach ($orderDetails->where('order_id', $row->id) as $data)
                                        <span class="h6 mb-2">
                                            {{ $data->product->title }}<br>
                                            {{ $data->product->color }} | {{ $data->size }} x {{ $data->qty }} items
                                        </span>
                                    @endforeach
                                    <div class="d-flex justify-content-start align-items-center">
                                        <form action="{{ route('customer.order_accept') }}" onsubmit="return confirm('Are you sure you can accept the order?');" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $row->id }}">
                                            <small class="fw-bolder">
                                                <a href="{{ route('customer.view_order', $row->invoice) }}" class="text-primary">Lihat</a>
                                            </small>
                                            @if ($row->status == 3 && $row->return_count == 0)
                                                <span class="fw-normal smaller h6 ms-2 me-2">|</span>
                                                <button type="submit" class=" fw-bolder bg-transparent border-0 small text-primary">Terima</button>
                                                <span class="fw-normal smaller h6 ms-2 me-2">|</span>
                                                <small class="fw-bolder">
                                                    <a href="{{ route('customer.order_return', $row->invoice) }}" class="text-primary">Pengembalian</a>
                                                </small>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <p class="d-grid justify-content-start align-content-center mb-0">
                                <small class="text-muted fw-bolder">Anda tidak memiliki pesanan dalam riwayat pesanan Anda.</small>
                            </p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
