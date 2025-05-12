@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Pelanggan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Lainnya</a></li>
                            <li class="breadcrumb-item active">Pelanggan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pelanggan</h4>
                        <form method="POST" action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Nama Depan</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $customer->first_name) }}">
                                        <p class="text-danger">{{ $errors->first('first_name') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Nama Belakang</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $customer->last_name) }}">
                                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}">
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor HP</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $customer->address) }}</textarea>
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('category.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
