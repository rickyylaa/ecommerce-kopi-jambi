@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a title="Akun" href="{{ route('customer.account') }}">Akun</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Pengaturan</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">Pengaturan</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('customer.setting') }}" enctype="multipart/form-data" class="pt-12">
            @csrf
            <div class="row">
                <div class="col-lg-12 order-lg-first pe-xl-20 pe-lg-6">
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-6 mb-md-0 mb-7">
                                <label for="first_name" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Nama Depan</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Nama Depan" value="{{ auth()->guard('customer')->user()->first_name }}">
                                <p class="text-danger">{{ $errors->first('first_name') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Nama Belakang</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Nama Belakang" value="{{ auth()->guard('customer')->user()->last_name }}">
                                <p class="text-danger">{{ $errors->first('last_name') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-12 mb-md-0 mb-7">
                                <label for="email" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ auth()->guard('customer')->user()->email }}"  {{ auth()->guard('customer')->check() ? 'readonly':'' }}>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-12 mb-md-0 mb-7">
                                <label for="country" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Negara</label>
                                <select name="country" id="country" class="form-select">
                                    <option value="Indonesia">Indonesia</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('country') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-12 mb-md-0 mb-7">
                                <label for="province_id" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Provinsi</label>
                                @php
                                    $province = DB::table('provinces')->orderBy('name', 'ASC')->get();
                                @endphp
                                <select name="province_id" id="province_id" class="form-select">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($province as $row)
                                        <option value="{{ $row->id }}" {{ $customer->district->province_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('province_id') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-4 mb-md-0 mb-7">
                                <label for="city_id" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Kota</label>
                                <select name="city_id" id="city_id" class="form-select">
                                    <option value="">Pilih Kota</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('city_id') }}</p>
                            </div>
                            <div class="col-md-4 mb-md-0 mb-7">
                                <label for="district_id" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Kecamatan</label>
                                <select name="district_id" id="district_id" class="form-select">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('district_id') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Kode Pos</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Kode Pos" value="{{ auth()->guard('customer')->user()->postal_code }}">
                                <p class="text-danger">{{ $errors->first('postal_code') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-12 mb-md-0 mb-7">
                                <label for="address" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Alamat</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Alamat" value="{{ auth()->guard('customer')->user()->address }}">
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-12 mb-md-0 mb-7">
                                <label for="address2" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Alamat Lengkap</label>
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="Alamat" value="{{ auth()->guard('customer')->user()->address2 }}">
                                <p class="text-danger">{{ $errors->first('address2') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-7">
                        <div class="row">
                            <div class="col-md-12 mb-md-0 mb-7">
                                <label for="phone" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Telp</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Telp" value="{{ auth()->guard('customer')->user()->phone }}">
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
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

@section('js')
<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
@endsection

@section('script')
    <script>
    $(document).ready(function() {
        loadCity($('#province_id').val(), 'bySelect').then(() => {
            loadDistrict($('#city_id').val(), 'bySelect');
        });
    });

    $('#province_id').on('change', function() {
        loadCity($(this).val(), '');
    });

    $('#city_id').on('change', function() {
        loadDistrict($(this).val(), '');
    });

    function loadCity(province_id, type) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: province_id },
                success: function(html){
                    $('#city_id').empty();
                    $('#city_id').append('');
                    $.each(html.data, function(key, item) {
                        let city_selected = {{ $customer->district->city_id }};
                        let selected = type == 'bySelect' && city_selected == item.id ? 'selected' : '';
                        $('#city_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>');
                        resolve();
                    });
                }
            });
        });
    }

    function loadDistrict(city_id, type) {
        $.ajax({
            url: "{{ url('/api/district') }}",
            type: "GET",
            data: { city_id: city_id },
            success: function(html){
                $('#district_id').empty();
                $('#district_id').append('');
                $.each(html.data, function(key, item) {
                    let district_selected = {{ $customer->district->id }};
                    let selected = type == 'bySelect' && district_selected == item.id ? 'selected' : '';
                    $('#district_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>');
                });
            }
        });
    }
    </script>
@endsection
