@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a title="Pesanan Anda" href="{{ route('customer.view_order', $order->invoice) }}">Pesanan Anda</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Konfirmasi Pemabayaran</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">KONFIRMASI PEMBAYARAN</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('customer.storePayment') }}" enctype="multipart/form-data" class="pt-12">
            @csrf
            <div class="row">
                @if($order->status == 0)
                    <div class="col-lg-12 order-lg-first pe-xl-20 pe-lg-6">
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-7">
                                    <label for="invoice" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Invoice</label>
                                    <input type="text" name="invoice" id="invoice" class="form-control" placeholder="Invoice" value="{{ request()->invoice }}" readonly>
                                    <p class="text-danger">{{ $errors->first('invoice') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Pengirim</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Belakang" value="{{ old('name', $order->customer_name) }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-7">
                                    <label for="transfer_to" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Bank Tujuan</label>
                                    <select name="transfer_to" id="transfer_to" class="form-select">
                                        <option value="">Pilih Bank</option>
                                        <option value="BCA - 1234567">BCA: 8190535429 a.n Aldino Ramadhani</option>
                                        <option value="BRI - 9876543">BRI: 819053542927641 a.n Aldino Ramadhani</option>
                                        <option value="BNI - 6789456">BNI: 8190535429 a.n Aldino Ramadhani</option>
                                        <option value="DANA - 6789456">DANA: 0895620783282 a.n Aldino Ramadhani</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="amount" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Jumlah</label>
                                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Jumlah" value="{{ old('amount', $order->subtotal + $order->cost) }}" required>
                                    <p class="text-danger">{{ $errors->first('amount') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-7">
                                    <label for="transfer_date" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Tanggal Transfer</label>
                                    <input type="date" name="transfer_date" id="transfer_date" class="form-control" placeholder="Tanggal Transfer" required>
                                    <p class="text-danger">{{ $errors->first('transfer_date') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="proof" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Bukti Transfer</label>
                                        <input type="file" name="proof" id="proof" class="form-control" required>
                                    <p class="text-danger">{{ $errors->first('proof') }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary mt-md-7 mt-4">Kirim</button>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12 order-lg-first pe-xl-20 pe-lg-6">
                        <p class="mb-2">Anda telah melakukan pembayaran</p>
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>
@endsection
