@extends('layouts.backend.admin')
@section('title', $title ?? 'Trang Quản Lý')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase;  ">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                    style="text-transform: capitalize;">bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>

        </section>
        <section class="content">
            <div class="row">
                <div class="col-5">
                    <form action="{{ route('slider.store') }}" name="form1" method="post" enctype="multipart/form-data">
                        <!-- Default box --> @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i> Lưu[Thêm]
                                        </button>
                                        <a class="btn btn-sm btn-info" href="{{ route('slider.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @includeIf('backend.message_alert')


                                <div class="mb-3">
                                    <label for="name">Tên banner</label>
                                    <input name="name" id="name" type="text" class="form-control "
                                        placeholder="vd: " value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="link">Liên kết</label>
                                    <input name="link" id="link" type="text" class="form-control "
                                        placeholder="#" value="{{ old('link') }}">
                                    @if ($errors->has('link'))
                                        <div class="text-danger">
                                            {{ $errors->first('link') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="position">Vị trí</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="slideshow">slideshow</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sort_order">Sắp xếp</label>
                                        <select name="sort_order" id="sort_order" class="form-control">
                                            <option value="0">--chon vị trí--</option>
                                            {!! $html_sort_order !!}
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input name="image" id="image" type="file" class="form-control btn-sm">
                                    @if ($errors->has('image'))
                                        <div class="text-danger">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : ' ' }}>Xuất bản
                                        </option>
                                        <option value="2" {{ old('status') == 2 ? 'selected' : ' ' }}>Không xuất bản
                                        </option>

                                    </select>
                                </div>



                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i> Lưu[Thêm]
                                        </button>
                                        <a class="btn btn-sm btn-info" href="{{ route('slider.index') }}">
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
                    <form action="{{ route('slider.delete_multi') }}" name="form1" method="post">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('slider.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('slider.trash') }}">
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
                                            <th class="text-center" style="width:20%">Tiêu banner</th>
                                            <th class="text-center">Link</th>
                                            <th class="text-center" style="width:20%">Ngày tạo</th>
                                            <th class="text-center" style="width:20%">Chức năng</th>
                                            <th class="text-center" style="width:5%">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slider as $row)
                                            <tr>
                                                <td class="text-center" style="width:20px">
                                                    <div class="form-group">
                                                        <input name="checkId[]" type="checkbox" id="web-developer"
                                                            value="{{ $row->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ asset('images/slider/' . $row->image) }}"
                                                        class="img-fluid" alt="">
                                                </td>
                                                <td>
                                                    {{ $row->name }}
                                                </td>
                                                <td>
                                                    {{ $row->link }}

                                                </td>

                                                <td class="text-center">
                                                    {{ $row->created_at }}

                                                </td>
                                                <td class="text-center">

                                                    @if ($row->status == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('slider.status', ['slider' => $row->id]) }}">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('slider.status', ['slider' => $row->id]) }}">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif

                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('slider.show', ['slider' => $row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('slider.edit', ['slider' => $row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('slider.delete', ['slider' => $row->id]) }}">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('slider.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('slider.trash') }}">
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

            <!-- /.card-footer-->
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

@endsection
