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
                            <div>
                                <div class="text-center">
                                    <div>
                                        <a href="{{ route('front.index') }}">
                                            <img src="{{ asset('assets/images/others/logo.png') }}" alt="logo" height="20" class="auth-logo logo-dark mx-auto">
                                            <img src="{{ asset('assets/images/others/logo-light.png') }}" alt="logo" height="20" class="auth-logo logo-light mx-auto">
                                        </a>
                                    </div>
                                </div>
                                <div class="p-2 mt-5">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3 auth-form-group-custom mb-4">
                                            <i class="ri-user-2-line auti-custom-input-icon"></i>
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Masukan Email">
                                        </div>
                                        <div class="mb-3 auth-form-group-custom mb-4">
                                            <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="remember-me" id="remember-me" class="form-check-input">
                                            <label class="form-check-label" for="remember-me">Tetap masuk</label>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <button type="submit" class="btn btn-primary w-md waves-effect waves-light">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-5 text-center">
                                    <p>© <script>document.write(new Date().getFullYear())</script> Kopi Jambi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="authentication-bg" style="background-image: url({{ asset('assets/images/background/kopi-jambi.jpg') }});">
                <div class="bg-overlay"></div>
            </div>
        </div>
    </div>
</div>
@endsection
