@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Keranjang Belanja</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">KERANJANG BELANJA</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="shopping-cart">
            <form method="POST" action="{{ route('front.update_cart') }}" class="table-responsive-md pb-8 pb-lg-10">
                @csrf
                <table class="table border">
                    <thead class="bg-body-secondary">
                        <tr class="fs-15px letter-spacing-01 fw-semibold text-uppercase text-body-emphasis">
                            <th scope="col" class="fw-semibold border-1 ps-11">PRODUK</th>
                            <th scope="col" class="fw-semibold border-1">QUANTITY</th>
                            <th colspan="2" class="fw-semibold border-1">HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($carts) > 0)
                            @foreach ($carts as $row)
                                <tr class="position-relative">
                                    <th scope="row" class="pe-5 ps-8 py-7 shop-product">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-6 me-7">
                                                <img src="#" data-src="{{ asset('storage/products/'. $row['product_image']) }}" class="lazy-image" width="75" height="100" alt="produk">
                                            </div>
                                            <div class>
                                                <p class="fw-500 mb-1 text-body-emphasis">{{ $row['product_title'] }}</p>
                                                <p class="card-text">
                                                    <span class="fs-15px fw-bold text-body-emphasis pe-3">Berat {{ number_format($row['weight']) }} gr</span>
                                                </p>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="align-middle">
                                        <div class="input-group position-relative shop-quantity">
                                            <a href="#" class="position-absolute translate-middle-y top-50 start-0 ps-7 product-info-2-minus" onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;">
                                                <i class="far fa-minus"></i>
                                            </a>
                                            <input type="number" name="qty[]" id="sst{{ $row['product_id'] }}" class="product-info-2-quantity form-control w-100 px-6 text-center" min="1" max="10" value="{{ $row['qty'] }}">
                                            <input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}">
                                            <a href="#" class="position-absolute translate-middle-y top-50 end-0 pe-7 product-info-2-plus" onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;">
                                                <i class="far fa-plus"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <p class="mb-0 text-body-emphasis fw-bold mr-xl-11">IDR {{ number_format($row['product_price']) }}</p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="pt-5 pb-10 position-relative bg-body ps-0 left">
                                    <a href="{{ route('front.product') }}" title="Lanjutkan Belanja" class="btn btn-outline-dark me-8 text-nowrap my-5"> Lanjutkan Belanja </a>
                                </td>
                                <td colspan="3" class="text-end pt-5 pb-10 position-relative bg-body right pe-0">
                                    <button type="submit" class="btn btn-outline-dark my-5">Update Keranjan </button>
                                </td>
                            </tr>
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
            </form>
            <div class="row justify-content-end pt-8 pt-lg-11 pb-16 pb-lg-18">
                <div class="col-lg-4 pt-lg-0 pt-11">
                    <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                        <div class="card-body px-9 pt-6">
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <span>Subtotal:</span>
                                <span class="d-block ml-auto text-body-emphasis fw-bold">IDR {{ number_format($subtotal) }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent px-0 pt-5 pb-7 mx-9">
                            <div class="d-flex align-items-center justify-content-between fw-bold mb-7">
                                <span class="text-secondary text-body-emphasis">Total:</span>
                                <span class="d-block ml-auto text-body-emphasis fs-4 fw-bold">IDR {{ number_format($subtotal = \App\Http\Helper::getTotalCartPrice()) }}</span>
                            </div>
                            <a href="{{ route('front.checkout') }}" class="btn w-100 btn-dark btn-hover-bg-primary btn-hover-border-primary" title="Check Out">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
