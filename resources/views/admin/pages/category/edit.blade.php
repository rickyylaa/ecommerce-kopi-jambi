@extends('admin.layouts.app')
@section('title', 'Kopi Jambi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kategori</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Halaman</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Kategori</h4>
                        <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $category->title) }}">
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('status') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="parent_id" class="form-label">Parent</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="">Pilih Parent</option>
                                            @foreach ($parent as $row)
                                                <option value="{{ $row->id }}" {{ $category->parent_id == $row->id ? 'selected' : '' }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('parent_id') }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $category->description) }}</textarea>
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('category.index') }}" class="btn btn-secondary me-2">Kembali</a>
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
