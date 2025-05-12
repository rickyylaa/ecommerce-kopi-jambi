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
                        <div class="dropdown float-end">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".customerModal">Tambah</button>
                        </div>
                        <h4 class="card-title mb-4">Pelanggan</h4>
                        <div class="table-responsive">
                            <table class="table table-centered align-middle" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($customer) > 0)
                                        @foreach ($customer as $row)
                                            <tr>
                                                <td></td>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->phone }}</td>
                                                <td>{{ $row->address }}</td>
                                                <td>
                                                    {!! $row->status_label !!}
                                                </td>
                                                <td>
                                                    <div>
                                                        <form method="POST" action="{{ route('customer.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('customer.edit', $row->id) }}" class="text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                            <button type="submit" class="text-danger" style="background: none; border: none;"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <div class="col-12">
                                                    <div class="text-center mt-4">
                                                        <span class="d-block ml-auto text-body-emphasis fw-bold">Anda tidak memiliki data di tabel ini</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if (count($customer) > 0)
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <span class="text-bold">Menampilkan {{ $customer->firstItem() }} hingga {{ $customer->lastItem() }} dari {{ $customer->total() }} entri</span>
                            {!! $customer->links('pagination::bootstrap-4') !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Nama Depan</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                                <p class="text-danger">{{ $errors->first('first_name') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Nama Belakang</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                                <p class="text-danger">{{ $errors->first('last_name') }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
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
                                <label for="phone" class="form-label">Telp</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea name="address" id="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-light waves-effect me-2" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
