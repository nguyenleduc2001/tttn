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
            </div><!-- /.container-fluid -->

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-5">
                    <form action="{{ route('category.store') }}" name="form1" method="post"
                        enctype="multipart/form-data">
                        <!-- Default box --> @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i> Lưu[Thêm]
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @includeIf('backend.message_alert')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="name">Tên Danh Mục</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="One Piece" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <label for="metakey">Từ khóa</label>
                                            <textarea name="metakey" id="metakey" class="form-control" placeholder="Từ khóa">{{ old('metakey') }}</textarea>
                                            @if ($errors->has('metakey'))
                                                <div class="text-danger">
                                                    {{ $errors->first('metakey') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <label for="metadesc">Mô tả</label>
                                            <textarea name="metadesc" id="metadesc" class="form-control" placeholder="Mô tả">{{ old('metadesc') }}</textarea>
                                        </div>
                                        @if ($errors->has('metadesc'))
                                            <div class="text-danger">
                                                {{ $errors->first('metadesc') }}
                                            </div>
                                        @endif


                                        <div>
                                            <label for="sort_order">Sắp xếp</label>
                                            <select name="sort_order" id="sort_order" class="form-control bg-gray">
                                                <option value="0">--Chọn vị trí--</option>
                                                {!! $html_sort_order !!}
                                            </select>


                                        </div>
                                        <div>
                                            <label for="parent_id">Cấp cha</label>
                                            <select name="parent_id" id="parent_id" class="form-control bg-gray">
                                                <option value="0">--Chọn chủ đề--</option>
                                                {!! $html_parent_id !!}
                                            </select>
                                            <div class="mb-3">
                                                <label for="image">Hình đại diện</label>
                                                <input name="image" id="name" type="file" class="form-control">
                                            </div>

                                        </div>
                                        <div>
                                            <label for="status">Trạng thái</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" {{ old('status') == 1 ? 'selected' : ' ' }}>Xuất bản
                                                </option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : ' ' }}>Không
                                                    xuất
                                                    bản
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </form>
                </div>

                <div class="col-7">

                    <form action="{{ route('category.delete_multi') }}" name="form1" method="post">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('category.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('category.trash') }}">
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
                                            <th class="text-center" style="width: 15%;  height: 5%">HÌNH ĐẠI DIỆN</th>
                                            <th class="text-center" style="width: 25%;">Tên Danh Mục</th>
                                            <th class="text-center" style="width: 20%;"> Ngày Tạo</th>
                                            <th class="text-center" style="width: 20%;">Chức Năng</th>
                                            <th class="text-center" style="width: 5%;">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $row)
                                            <tr>
                                                <td class="text-center" style="width:20px">
                                                    <div class="form-group">
                                                        <input name="checkId[]" type="checkbox" id="web-developer"
                                                            value="{{ $row->id }}">
                                                    </div>
                                                </td>
                                                <td><img src="{{ asset('images/category/' . $row->image) }}"
                                                        class="img-fluid" alt="{{ $row->image }}"></td>
                                                <td>
                                                    {{ $row->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $row->created_at }}

                                                </td>
                                                <td class="text-center">

                                                    @if ($row->status == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('category.status', ['category' => $row->id]) }}">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('category.status', ['category' => $row->id]) }}">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif

                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('category.show', ['category' => $row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('category.edit', ['category' => $row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('category.delete', ['category' => $row->id]) }}">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('category.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('category.trash') }}">
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
            <!-- Default box -->

            <!-- /.card-footer-->
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

@endsection