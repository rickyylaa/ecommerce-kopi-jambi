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
                        <h4 class="card-title mb-4">Produk</h4>
                        <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $product->title) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Kategori</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}" {{ (($product->category_id == $row->id) ? 'selected' : '') }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Merek</label>
                                        <select name="brand_id" class="form-control">
                                            @foreach ($brand as $row)
                                                <option value="{{ $row->id }}" {{ (($product->brand_id == $row->id) ? 'selected' : '') }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="size_id" class="form-label">Ukuran</label>
                                        <select name="size_id" class="form-control">
                                            @foreach ($size as $row)
                                                <option value="{{ $row->id }}" {{ (($product->size_id == $row->id) ? 'selected' : '') }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga</label>
                                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Berat</label>
                                        <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', $product->weight) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="qty" class="form-label">Stok</label>
                                        <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty', $product->qty) }}">
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
                                        <label for="summary" class="form-label">Rincian</label>
                                        <textarea name="summary" id="summary" class="form-control" rows="5">{{ old('summary', $product->summary) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $product->summary) }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('product.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
