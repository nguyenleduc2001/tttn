@extends('layouts.backend.admin')
@section('title', $title ?? 'Trang Quản Lý')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-danger">
                        <h1 style="text-transform: uppercase;  ">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('menu.index') }}"
                                    style="text-transform: capitalize;">tất cả menu</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{ route('menu.trash_multi') }}" name="form1" method="post">
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

                                    <a class="btn btn-sm btn-info" href="{{ route('menu.index') }}">
                                        <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                    </a>
                                    <button name="RESTORE_ALL" class="btn btn-sm btn-info" type="submit">
                                        <i class="fa-solid fa-arrow-rotate-left"></i>Phục hồi đã chọn
                                    </button>
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
                                    <th class="text-center" style="width:15%">Tên menu</th>
                                    <th class="text-center" style="width:20%">Liên kết</th>
                                    <th class="text-center" style="width:20%">Loại</th>
                                    <th class="text-center" style="width:15%">Ngày tạo</th>

                                    <th class="text-center" style="width:20%">Chức năng</th>
                                    <th class="text-center" style="width:5%">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menu as $row)
                                    <tr>
                                        <td class="text-center" style="width:20px">
                                            <div class="form-group">
                                                <input name="checkId[]" type="checkbox" id="web-developer"
                                                    value="{{ $row->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            {{ $row->name }}
                                        </td>
                                        <td>
                                            {{ $row->link }}

                                        </td>
                                        <td>
                                            {{ $list_type[$row->type] }}


                                        </td>
                                        <td class="text-center">
                                            {{ $row->created_at }}

                                        </td>
                                        <td class="text-center">


                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('menu.show', ['menu' => $row->id]) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('menu.restore', ['menu' => $row->id]) }}">
                                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger"
                                                href="{{ route('menu.destroy', ['menu' => $row->id]) }}">
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

                                    <a class="btn btn-sm btn-info" href="{{ route('menu.index') }}">
                                        <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                    </a>
                                    <button name="RESTORE_ALL" class="btn btn-sm btn-info" type="submit">
                                        <i class="fa-solid fa-arrow-rotate-left"></i>Phục hồi đã chọn
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </form>
            <!-- /.card-footer-->
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

@endsection
