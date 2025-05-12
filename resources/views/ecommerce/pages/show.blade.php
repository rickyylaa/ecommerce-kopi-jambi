@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="z-index-2 position-relative pb-2 mb-12">
    <div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a title="Produk" href="{{ route('front.product') }}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="container pt-6">
    <div class="row ">
        <div class="col-md-6 pe-lg-13">
            <div class="position-relative">
                <div class="slick-slider slick-slider-arrow-inside slick-slider-dots-inside slick-slider-dots-light g-0" data-slick-options="{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slider-thumb&#34;,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}">
                    <a href="{{ asset('storage/products/'. $product->image) }}" data-gallery="gallery1">
                        <img src="#" data-src="{{ asset('storage/products/'. $product->image) }}" class="h-auto lazy-image" width="540" height="720" alt>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-md-0 pt-10">
            <h1 class="mb-4 pb-2 fs-4">{{ $product->title }}</h1>
            <p class="d-flex align-items-center mb-6">
                <span class="fs-18px text-body-emphasis fw-bold">IDR {{ number_format($product->price) }}</span>
            </p>
            <p class="fs-15px">{{ $product->description }}</p>
            <form action="{{ route('front.cart') }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group col-sm-4">
                        <label class=" text-body-emphasis fw-semibold fs-15px pb-6" for="number">Quantity: </label>
                        <div class="input-group position-relative w-100 input-group-lg">
                            <a href="#" class="position-absolute translate-middle-y top-50 start-0 ps-7 product-info-2-minus" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;">
                                <i class="far fa-minus"></i>
                            </a>
                            <input type="number" name="qty" id="sst" class="product-info-2-quantity form-control w-100 px-6 text-center" min="1" max="10" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <a href="#" class="position-absolute translate-middle-y top-50 end-0 pe-7 product-info-2-plus" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst < {{ $product->qty }}) result.value++;return false;">
                                <i class="far fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8 pt-9 mt-2 mt-sm-0 pt-sm-0">
                        <button type="submit" class="btn-hover-bg-primary btn-hover-border-primary btn btn-lg btn-dark w-100">Tambah Kekeranjang</button>
                    </div>
                </div>
            </form>
            <ul class="single-product-meta list-unstyled border-top pt-7 mt-7">
                <li class="d-flex mb-4 pb-2 align-items-center">
                    <span class="text-body-emphasis fw-semibold fs-14px">Kategori:</span>
                    <span class="ps-4">{{ $product->category->title }}</span>
                </li>
                <li class="d-flex mb-4 pb-2 align-items-center">
                    <span class="text-body-emphasis fw-semibold fs-14px">Merek:</span>
                    <span class="ps-4">{{ $product->brand->title }}</span>
                </li>
                <li class="d-flex mb-4 pb-2 align-items-center">
                    <span class="text-body-emphasis fw-semibold fs-14px">Ukuran:</span>
                    <span class="ps-4">{{ $product->size->title }}</span>
                </li>
                <li class="d-flex mb-4 pb-2 align-items-center">
                    <span class="text-body-emphasis fw-semibold fs-14px">Berat:</span>
                    <span class="ps-4">{{ $product->weight }} gram</span>
                </li>
                <li class="d-flex mb-4 pb-2 align-items-center">
                    <span class="text-body-emphasis fw-semibold fs-14px">Stok:</span>
                    <span class="ps-4">{{ $product->qty }} item</span>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection
