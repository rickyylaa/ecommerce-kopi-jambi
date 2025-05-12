@extends('auth.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-lg-4">
            <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                <div class="w-100">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="d-flex mt-5 text-center">
                                <p>Halaman Tidak Ada</p>
                                <a href="{{ route('login') }}">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
