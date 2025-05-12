@extends('ecommerce.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<section class="pb-16 pb-lg-18 ">
    <div class="bg-body-secondary py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                <li class="breadcrumb-item"><a title="Beranda" href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Check Out</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class=" text-center pt-13 mb-12 mb-lg-15">
            <div class="text-center">
                <h2 class="fs-36px mb-11 mb-lg-14">CHECK OUT</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('front.store_checkout') }}" novalidate="novalidate" class="pt-12">
            @csrf @method('POST')
            <div class="row">
                <div class="col-lg-4 pb-lg-0 pb-14 order-lg-last">
                    <div class="card border-0 rounded-0 shadow">
                        <div class="card-header px-0 mx-10 bg-transparent py-8">
                            <h4 class="fs-4 mb-8">Ringkasan Pesanan</h4>
                            @if (count($carts) > 0)
                                @foreach ($carts as $data)
                                    <div class="d-flex w-100 mb-7">
                                        <div class="me-6">
                                            <img src="#" data-src="{{ asset('storage/products/' . $data['product_image']) }}" class="lazy-image" width="60" height="80" alt="product">
                                        </div>
                                        <div class="d-flex flex-grow-1">
                                            <div class="pe-6">
                                                <a href="#" class>{{ $data['product_title'] }}<span class="text-body"> x{{ $data['qty'] }}</span></a>
                                                <p class="fs-14px text-body-emphasis mb-0 mt-1">
                                                    Berat: <span class="text-body">{{ $data['weight'] }} gr</span>
                                                </p>
                                            </div>
                                            <div class="ms-auto">
                                                <p class="fs-14px text-body-emphasis mb-0 fw-bold">IDR {{ number_format($subtotal = \App\Http\Helper::getTotalCartPrice()) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            @endif
                        </div>
                        <div class="card-body px-10 py-8">
                            <div class="d-flex align-items-center mb-2">
                                <span>Subtotal:</span>
                                <span class="d-block ms-auto text-body-emphasis fw-bold">IDR {{ number_format($subtotal) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span>Ongkir:</span>
                                <span class="d-block ms-auto text-body-emphasis fw-bold" id="shipping">IDR 0</span>
                                <input type="hidden" name="shipping" id="shipping_input">
                            </div>
                        </div>
                        <div class="card-footer bg-transparent py-5 px-0 mx-10">
                            <div class="d-flex align-items-center fw-bold mb-6">
                                <span class="text-body-emphasjais p-0">Total:</span>
                                @php
                                    $total_amount = \App\Http\Helper::getTotalCartPrice();
                                @endphp
                                <span class="d-block ms-auto text-body-emphasis fs-4 fw-bold" id="total">IDR {{ number_format($total_amount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-lg-first pe-xl-20 pe-lg-6">
                    <div class="checkout">
                        <h4 class="fs-4 pt-4 mb-7">Informasi Pengiriman</h4>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-7">
                                    <label for="customer_first_name" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Nama Depan</label>
                                    @if (auth()->guard('customer')->check())
                                        <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" placeholder="Nama Depan" value="{{ auth()->guard('customer')->user()->first_name }}" required>
                                    @else
                                        <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" placeholder="Nama Depan" value="{{ old('customer_first_name') }}" required>
                                    @endif
                                    <p class="text-danger">{{ $errors->first('customer_first_name') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="customer_last_name" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Nama Belakang</label>
                                    @if (auth()->guard('customer')->check())
                                        <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" placeholder="Nama Belakang" value="{{ auth()->guard('customer')->user()->last_name }}" required>
                                    @else
                                        <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" placeholder="Nama Belakang" value="{{ old('customer_last_name') }}" required>
                                    @endif
                                    <p class="text-danger">{{ $errors->first('customer_last_name') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-12 mb-md-0 mb-7">
                                    <label for="email" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Email</label>
                                    @if (auth()->guard('customer')->check())
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ auth()->guard('customer')->user()->email }}"  {{ auth()->guard('customer')->check() ? 'readonly':'' }} required>
                                    @else
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                    @endif
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-12 mb-md-0 mb-7">
                                    <label for="customer_country" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Negara</label>
                                    <select name="customer_country" id="customer_country" class="form-select">
                                        <option value="Indonesia">Indonesia</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('customer_country') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="tab-content">
                                <div class="tab-pane active show fade" id="cod-close">
                                    <div class="mb-7">
                                        <div class="row">
                                            <div class="col-12 mb-md-0 mb-7">
                                                <label for="province_id" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Provinsi</label>
                                                @php
                                                    $province = DB::table('provinces')->orderBy('name', 'ASC')->get();
                                                @endphp
                                                @if (auth()->guard('customer')->check())
                                                    <select name="province_id" id="province_id" class="form-select" required>
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($province as $row)
                                                            <option value="{{ $row->id }}" {{ $customer->district->province_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="province_id" id="province_id" class="form-select" required>
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($province as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
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
                                                <label for="customer_postal_code" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Kode Pos</label>
                                                @if (auth()->guard('customer')->check())
                                                    <input type="text" name="customer_postal_code" id="customer_postal_code" class="form-control" placeholder="Kode Pos" value="{{ auth()->guard('customer')->user()->postal_code }}" required>
                                                @else
                                                    <input type="text" name="customer_postal_code" id="customer_postal_code" class="form-control" placeholder="Kode Pos" value="{{ old('customer_postal_code') }}" required>
                                                @endif
                                                <p class="text-danger">{{ $errors->first('customer_postal_code') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-7">
                                        <div class="row">
                                            <div class="col-md-12 mb-md-0 mb-7">
                                                <label for="customer_address" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Alamat</label>
                                                @if (auth()->guard('customer')->check())
                                                    <input type="text" name="customer_address" id="customer_address" class="form-control" placeholder="Alamat" value="{{ auth()->guard('customer')->user()->address }}" required>
                                                @else
                                                    <input type="text" name="customer_address" id="customer_address" class="form-control" placeholder="Alamat" value="{{ old('customer_address') }}" required>
                                                @endif
                                                <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-7">
                                        <div class="row">
                                            <div class="col-md-12 mb-md-0 mb-7">
                                                <label for="customer_phone" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Telp</label>
                                                @if (auth()->guard('customer')->check())
                                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Telp" value="{{ auth()->guard('customer')->user()->phone }}" required>
                                                @else
                                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Telp" value="{{ old('customer_phone') }}" required>
                                                @endif
                                                <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-7">
                                        <div class="row">
                                            <div class="col-12 mb-md-0 mb-7">
                                                <input type="hidden" name="weight" id="weight" value="{{ $weight }}">
                                                <label for="courier" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Kurir</label>
                                                <select name="courier" id="courier" class="form-control" required>
                                                    <option value="">Pilih Kurir</option>
                                                    <option value="jne">JNE</option>
                                                    <option value="tiki">TIKI</option>
                                                    <option value="pos">POS INDONESIA</option>
                                                </select>
                                                <p class="text-danger">{{ $errors->first('courier') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cod-open">
                                    <div class="mb-7">
                                        <div class="row">
                                            <div class="col-md-12 mb-md-0 mb-7">
                                                <label for="customer_address2" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Alamat Lengkap</label>
                                                @if (auth()->guard('customer')->check())
                                                    <input type="text" name="customer_address2" id="customer_address2" class="form-control" placeholder="Alamat Lengkap" value="{{ auth()->guard('customer')->user()->address }}" required>
                                                @else
                                                    <input type="text" name="customer_address2" id="customer_address2" class="form-control" placeholder="Alamat Lengkap" value="{{ old('customer_address2') }}" required>
                                                @endif
                                                <p class="text-danger">{{ $errors->first('customer_address2') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-7">
                                        <div class="row">
                                            <div class="col-md-12 mb-md-0 mb-7">
                                                <label for="customer_phone" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Telp</label>
                                                @if (auth()->guard('customer')->check())
                                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Telp" value="{{ auth()->guard('customer')->user()->phone }}" required>
                                                @else
                                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Telp" value="{{ old('customer_phone') }}" required>
                                                @endif
                                                <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nav nav-tabs border-0 mt-7">
                                <input type="checkbox" class="form-check-input rounded-0 me-4" data-bs-toggle="tab" data-bs-target="#cod-open" id="cod-open-checkbox">
                                <label class="text-body-emphasis" for="cod-open-checkbox">
                                    <span class="text-body-emphasis">COD (Cash on delivery)</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary mt-md-7 mt-4">Kirim</button>
                        </div>
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

@if (auth()->guard('customer')->user())
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

        function updateTotalWithShipping(subtotal, shippingCost) {
            var total = subtotal + shippingCost;
            $('#total').text("IDR " + total.toLocaleString());
        }

        $('#courier').on('change', function() {
            $('#shipping').text("Calculating..");

            var destination = $('#city_id').val();
            var weight = $('#weight').val();
            var courier = $(this).val();

            var requestData = {
                destination: destination,
                weight: weight,
                courier: courier
            };

            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "GET",
                data: requestData,
                success: function(resp) {
                    var cost = resp?.rajaongkir?.results?.[0]?.costs?.[0]?.cost?.[0]?.value;
                    if (cost) {
                        $('#shipping').text("IDR " + cost.toLocaleString());
                        $('#shipping_input').val(cost);
                        var subtotal = parseFloat("{{ $subtotal }}");
                        updateTotalWithShipping(subtotal, cost);
                    } else {
                        $('#shipping').text("Courier not available.");
                    }
                },
                error: function() {
                    $('#shipping').text("Error while fetching data.");
                }
            });
        });
        </script>
        <script>
            $(document).ready(function() {
                $('#cod-open').hide();
                $('#cod-open-checkbox').change(function() {
                    if($(this).is(':checked')) {
                    $('#cod-open').show();
                    $('#cod-close').hide();
                    } else {
                $('#cod-open').hide();
                $('#cod-close').show();
            }
            });
        });
        </script>
    @endsection
@else
    @section('script')
        <script>
        $('#province_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){
                    $('#city_id').empty()
                    $('#city_id').append('')
                    $.each(html.data, function(key, item) {
                        $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })

        $('#city_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: { city_id: $(this).val() },
                success: function(html){
                    $('#district_id').empty()
                    $('#district_id').append('')
                    $.each(html.data, function(key, item) {
                        $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })

        function updateTotalWithShipping(subtotal, shippingCost) {
            var total = subtotal + shippingCost;
            $('#total').text("IDR " + total.toLocaleString());
        }

        $('#courier').on('change', function() {
            $('#shipping').text("Calculating..");

            var destination = $('#city_id').val();
            var weight = $('#weight').val();
            var courier = $(this).val();

            var requestData = {
                destination: destination,
                weight: weight,
                courier: courier
            };

            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "GET",
                data: requestData,
                success: function(resp) {
                    var cost = resp?.rajaongkir?.results?.[0]?.costs?.[0]?.cost?.[0]?.value;
                    if (cost) {
                        $('#shipping').text("IDR " + cost.toLocaleString());
                        $('#shipping_input').val(cost);
                        var subtotal = parseFloat("{{ $subtotal }}");
                        updateTotalWithShipping(subtotal, cost);
                    } else {
                        $('#shipping').text("Courier not available.");
                    }
                },
                error: function() {
                    $('#shipping').text("Error while fetching data.");
                }
            });
        });
        </script>
    @endsection
@endif
