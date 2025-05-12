@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">PRODUK</h2>
            </div>
        </div>
    </div>
    <div class="container container-xxl">
        <div class="tool-bar mb-11 align-items-center justify-content-between d-lg-flex">
            <div class="tool-bar-left mb-6 mb-lg-0 fs-18px">Kami menemukan
                <span class="text-body-emphasis fw-semibold">{{ $product->count() }}</span>
                produk yang tersedia untuk Anda
            </div>
        </div>
        <div class="row gy-50px">
            @foreach ($product as $row)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card card-product grid-2 bg-transparent border-0">
                        <figure class="card-img-top position-relative mb-7 overflow-hidden">
                            <a href="{{ route('front.show', $row->slug) }}" class="hover-zoom-in d-block" title="Facial cleanser">
                                <img src="{{ route('front.show', $row->slug) }}" data-src="{{ asset('storage/products/'. $row->image) }}" class="img-fluid lazy-image w-100" alt="Facial cleanser" width="330" height="440">
                            </a>
                        </figure>
                        <div class="card-body text-center p-0">
                            <span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                <ins class="text-decoration-none">IDR {{ number_format($row->price) }}</ins>
                            </span>
                            <h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                                <a class="text-decoration-none text-reset" href="{{ route('front.show', $row->slug) }}">{{ $row->title }}</a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {!! $product->links('pagination::default') !!}
    </div>
</section>
@endsection
