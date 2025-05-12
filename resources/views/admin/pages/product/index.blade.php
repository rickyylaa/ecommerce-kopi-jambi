@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Produk</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Halaman</a></li>
                            <li class="breadcrumb-item active">Produk</li>
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
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".productModal">Tambah</button>
                        </div>
                        <h4 class="card-title mb-4">Produk</h4>
                        <div class="table-responsive">
                            <table class="table table-centered align-middle" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Detail</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($product) > 0)
                                        @foreach ($product as $row)
                                            <tr>
                                                <td></td>
                                                <td>{{ $row->id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/products/'. $row->image) }}" alt="product-img" class="avatar-lg">
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled product-desc-list">
                                                        <li>{{ $row->title }}</li>
                                                        <li>Kategori: {{ $row->category->title }}</li>
                                                        <li>Merek: {{ $row->brand->title }}</li>
                                                        <li>Ukuran: {{ $row->size->title }}</li>
                                                        <li>Berat: {{ $row->weight }} gr</li>
                                                        <li>Stok: {{ $row->qty }} item</li>
                                                    </ul>
                                                </td>
                                                <td>IDR {{ number_format($row->price) }}</td>
                                                <td>
                                                    {!! $row->status_label !!}
                                                </td>
                                                <td>
                                                    <div>
                                                        <form method="POST" action="{{ route('product.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('product.edit', $row->id) }}" class="text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
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
                        @if (count($product) > 0)
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <span class="text-bold">Menampilkan {{ $product->firstItem() }} hingga {{ $product->lastItem() }} dari {{ $product->total() }} entri</span>
                            {!! $product->links('pagination::bootstrap-4') !!}
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
<div class="modal fade productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($category as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="brand_id" class="form-label">Merek</label>
                                <select name="brand_id" class="form-control">
                                    @foreach ($brand as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="size_id" class="form-label">Ukuran</label>
                                <select name="size_id" class="form-control">
                                    @foreach ($size as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="weight" class="form-label">Berat</label>
                                <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="qty" class="form-label">Stok</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="image" class="form-label">Foto</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="summary" class="form-label">Ringkasan</label>
                                <textarea name="summary" id="summary" class="form-control" rows="5">{{ old('summary') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
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
