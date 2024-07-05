@extends('layouts.backend.admin')
@section('title', $title ?? 'Trang Quản Lý')
@section('content')
    <section class="content">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 text-success">
                            <h1 style="text-transform: uppercase;  ">{{ $title }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('page.index') }}"
                                        style="text-transform: capitalize;">Tất cả trang đơn</a></li>
                                <li class="breadcrumb-item active ">{{ $title }}</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-5">
                        <form action="{{ route('page.update', ['page' => $page->id]) }}" name="form1" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            <!-- Default box --> @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-save"></i> Lưu[Sửa]
                                            </button>
                                            <a class="btn btn-sm btn-info" href="{{ route('page.index') }}">
                                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @includeIf('backend.message_alert')

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">Chính</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="content-tab" data-bs-toggle="tab"
                                                data-bs-target="#content" type="button" role="tab"
                                                aria-controls="content" aria-selected="false">Nội
                                                Dung</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content p-3  border-right border-left border-bottom" id="myTabContent">
                                        <div class="tab-pane fade show active " id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <label for="title">Tên trang đơn</label>
                                                        <input type="text" name="title" id="title"
                                                            class="form-control" placeholder="Việt Nam"
                                                            value="{{ old('title', $page->title) }}">
                                                        @if ($errors->has('title'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('title') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        <label for="metakey">Từ khóa</label>
                                                        <textarea name="metakey" id="metakey" class="form-control" placeholder="Từ khóa"> {{ old('metakey', $page->metakey) }}</textarea>
                                                        @if ($errors->has('metakey'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('metakey') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <label for="metadesc">Mô tả</label>
                                                        <textarea name="metadesc" id="metadesc" class="form-control" placeholder="Mô tả"> {{ old('metadesc', $page->metadesc) }}</textarea>
                                                    </div>
                                                    @if ($errors->has('metadesc'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('metadesc') }}
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <label for="image">Hình đại diện</label>
                                                        <input type="file" name="image" id="image"
                                                            class="form-control" value="{{ old('image', $page->image) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1"
                                                                {{ old('status', $page->status) == 1 ? 'selected' : '' }}>
                                                                Xuất
                                                                bản</option>
                                                            <option value="2"
                                                                {{ old('status', $page->status) == 2 ? 'selected' : '' }}>
                                                                Chưa
                                                                xuất bản</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="content" role="tabpanel"
                                            aria-labelledby="content-tab">
                                            <div class="mb-3">
                                                <label for="detail">Chi tiết</label>
                                                <textarea name="detail" id="detail" cols="10" rows="2" class="form-control "
                                                    placeholder="Chi tiết">{{ old('detail', $page->detail) }}</textarea>
                                                @if ($errors->has('detail'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('detail') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>






                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-save"></i>Lưu[Sửa]
                                            </button>
                                            <a class="btn btn-sm btn-info" href="{{ route('page.index') }}">
                                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.card-footer-->
                                </div>
                            </div>
                            <!-- /.card -->
                        </form>
                    </div>
                    <div class="col-7">
                        <form action="{{ route('page.delete_multi') }}" name="form1" method="post">
                            @csrf
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                                                <i class="fas fa-trash"></i> Xóa đã chọn
                                            </button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="text-right">
                                                <a class="btn btn-sm btn-success" href="{{ route('page.create') }}">
                                                    <i class="fas fa-plus"></i> Thêm
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="{{ route('page.trash') }}">
                                                    <i class="fas fa-trash"></i> Thùng rác
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @includeIf('backend.message_alert')
                                    <table class="table table-bordered" id="myTable">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-center" style="width:5%">
                                                    <div class="form-group select-all">
                                                        <input type="checkbox" id="select-all">
                                                    </div>
                                                </th>
                                                <th class="text-center" style="width:10%">Hình</th>
                                                <th class="text-center" style="width:20%">Tiêu đề trang đơn</th>
                                                <th class="text-center" style="width:20%">Slug</th>
                                                <th class="text-center" style="width:20%">Ngày tạo</th>
                                                <th class="text-center" style="width:20%">Chức năng</th>
                                                <th class="text-center" style="width:5%">ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pageedit as $row)
                                                <tr>
                                                    <td class="text-center" style="width:20px">
                                                        <div class="form-group">
                                                            <input name="checkId[]" type="checkbox" id="web-developer"
                                                                value="{{ $row->id }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('images/post/' . $row->image) }}"
                                                            class="img-fluid" alt="">
                                                    </td>
                                                    <td>
                                                        {{ $row->title }}
                                                    </td>
                                                    <td>
                                                        {{ $row->slug }}

                                                    </td>
                                                    <td class="text-center">
                                                        {{ $row->created_at }}

                                                    </td>
                                                    <td class="text-center">

                                                        @if ($row->status == 1)
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('page.status', ['page' => $row->id]) }}">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </a>
                                                        @else
                                                            <a class="btn btn-sm btn-danger"
                                                                href="{{ route('page.status', ['page' => $row->id]) }}">
                                                                <i class="fas fa-toggle-off"></i>
                                                            </a>
                                                        @endif

                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('page.show', ['page' => $row->id]) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('page.edit', ['page' => $row->id]) }}">
                                                            <i class=" fas fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('page.delete', ['page' => $row->id]) }}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center" style="width:20px">
                                                        {{ $row->id }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                                                <i class="fas fa-trash"></i> Xóa đã chọn
                                            </button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="text-right">
                                                <a class="btn btn-sm btn-success" href="{{ route('page.create') }}">
                                                    <i class="fas fa-plus"></i> Thêm
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="{{ route('page.trash') }}">
                                                    <i class="fas fa-trash"></i> Thùng rác
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->
                        </form>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
    </section>
    <script>
        CKEDITOR.replace('detail')
    </script>
@endsection
