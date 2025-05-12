@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a title="Akun" href="{{ route('customer.account') }}">Akun</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Pengembalian</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">Pengembalian</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST"  action="{{ route('customer.return', $order->id) }}" enctype="multipart/form-data"class="pt-12">
            @csrf <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-lg-12 order-lg-first">
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-12 mb-md-0 mb-7">
                                <label for="reason" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Alasan</label>
                                <textarea name="reason" id="reason" class="form-control" placeholder="Alasan" rows="5"></textarea>
                                <p class="text-danger">{{ $errors->first('reason') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-12 mb-md-0 mb-7">
                                <label for="refund_transfer" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Pengembalian Uang Transfer</label>
                                <input type="text" name="refund_transfer" id="refund_transfer" class="form-control" value="{{ old('refund_transfer', $order->subtotal + $order->cost) }}" placeholder="Pengembalian Uang Transfer" readonly>
                                <p class="text-danger">{{ $errors->first('refund_transfer') }}</p>
                            </div>
                            <div class="col-12 mb-md-0 mb-7">
                                <label for="photo" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Bukti</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                                <p class="text-danger">{{ $errors->first('photo') }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary mt-md-7 mt-4">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
