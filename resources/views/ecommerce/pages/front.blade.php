@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section>
    @foreach ($banner as $row)
    <div class="slick-slider hero hero-header-11" data-slick-options="{&#34;arrows&#34;:false,&#34;autoplay&#34;:true,&#34;cssEase&#34;:&#34;ease-in-out&#34;,&#34;dots&#34;:false,&#34;fade&#34;:true,&#34;infinite&#34;:true,&#34;slidesToShow&#34;:1,&#34;speed&#34;:600}">
        <div class="vh-100 d-flex align-items-center text-white">
            <div class="z-index-2 container container-xxl py-21 pt-xl-10 pb-xl-11">
                <div class="hero-content text-start">
                    <div data-animate="fadeInDown">
                        <p class="mb-8 text-uppercase fw-bold fs-15px ls-2">{{ $row->title }}</p>
                        <h1 class="mb-7 hero-title text-white hero-desc fw-500 font-primary">{{ $row->summary }}</h1>
                        <p class="hero-desc fs-18px mb-11">{{ $row->description }}</p>
                    </div><a href="{{ route('front.product') }}" data-animate="fadeInUp" class="btn btn-white btn-lg btn-hover-bg-body-tertiary"> Beli Sekarang </a>
                </div>
            </div>
            <div class="lazy-bg bg-overlay position-absolute z-index-1 w-100 h-100" data-bg-src="{{ asset('storage/banners/'. $row->image) }}"></div>
        </div>
    </div>
    @endforeach
</section>

<section id="because_you_need_time_for_yourself_1" class="container mt-4 mt-lg-12 py-4 mb-15 mb-lg-18">
    <div class="row gy-50px">
        @foreach ($product as $row)
            <div class="col-12 col-sm-5 col-xl-3 ps-xl-9" data-animate="fadeInUp">
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
    <div class="text-center mt-12" data-animate="fadeInUp">
        <a href="{{ route('front.product') }}" class="btn btn-outline-dark"> Semua Produk </a>
    </div>
</section>
@endsection
