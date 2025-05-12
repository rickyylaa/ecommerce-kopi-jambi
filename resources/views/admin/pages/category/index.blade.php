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
                        <div class="dropdown float-end">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".categoryModal">Tambah</button>
                        </div>
                        <h4 class="card-title mb-4">Kategori</h4>
                        <div class="table-responsive">
                            <table class="table table-centered align-middle" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Parent</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($category) > 0)
                                        @foreach ($category as $row)
                                            <tr>
                                                <td></td>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->title }}</td>
                                                <td>{{ $row->parent ? $row->parent->title : '-' }}</td>
                                                <td>{{ $row->description }}</td>
                                                <td>
                                                    {!! $row->status_label !!}
                                                </td>
                                                <td>
                                                    <div>
                                                        <form method="POST" action="{{ route('category.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('category.edit', $row->id) }}" class="text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
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
                        @if (count($category) > 0)
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <span class="text-bold">Menampilkan {{ $category->firstItem() }} hingga {{ $category->lastItem() }} dari {{ $category->total() }} entri</span>
                            {!! $category->links('pagination::bootstrap-4') !!}
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
<div class="modal fade categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Parent</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Pilih Parent</option>
                                    @foreach ($category as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('parent_id') }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
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
