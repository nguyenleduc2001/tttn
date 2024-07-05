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
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}"
                                    style="text-transform: capitalize;">Tất cả thương hiệu</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        </section>
        <div class="row">
            <div class="col-5">
                <section class="content">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a class="btn btn-sm btn-info" href="{{ route('user.index') }}">
                                        <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                    </a>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('user.edit', ['user' => $user->id]) }} ">
                                        <i class=" fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ route('user.delete', ['user' => $user->id]) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @includeIf('backend.message_alert')
                            <table class="table table-bordered border-primary table-hover ">
                                <thead class="bg-primary">
                                    <tr class="fs-1">
                                        <th width="30%">
                                            Tên trường
                                        </th>
                                        <th>
                                            Giá trị
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Id</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Họ&Tên</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên tài khoản</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mật Khẩu</th>
                                        <td>{{ $user->password }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giới tính</th>

                                        <td>{{ $user->gender == 0 ? 'Nam' : 'Nữ' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Điện thoại</th>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hình đại diện</th>
                                        <td class="index-img">
                                            <img style="max-width: 150px" src="{{ asset('images/user/' . $user->image) }}"
                                                class=" img-fluid" alt="{{ $user->image }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Quyền</th>
                                        <td>{{ $user->roles == 1 ? 'Quản trị' : 'Khách hàng' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <td>{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Người tạo</th>
                                        <td>{{ $user->created_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày sửa cuối</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Người sửa cuối</th>
                                        <td>{{ $user->updated_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>{{ $user->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a class="btn btn-sm btn-info" href="{{ route('user.index') }}">
                                        <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                    </a>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('user.edit', ['user' => $user->id]) }} ">
                                        <i class=" fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ route('user.delete', ['user' => $user->id]) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

                </section>
            </div>
            <div class="col-7">
                <section class="content">

                    <!-- Default box -->
                    <form action="{{ route('user.delete_multi') }}" name="form1" method="post">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('user.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('user.trash') }}">
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
                                            <th class="text-center" style="width:20%">Tên tài khoản</th>
                                            <th class="text-center" style="width:15%">Email</th>
                                            <th class="text-center" style="width:10%">Phone</th>
                                            <th class="text-center" style="width:15%">Ngày tạo</th>
                                            <th style="width:20%" class="text-center">Chức năng</th>
                                            <th class="text-center" style="width:5%">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user1 as $row)
                                            <tr>
                                                <td class="text-center" style="width:20px">
                                                    <div class="form-group">
                                                        <input name="checkId[]" type="checkbox" id="web-developer"
                                                            value="{{ $row->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ asset('images/user/' . $row->image) }}"
                                                        class="img-fluid" alt="">
                                                </td>
                                                <td>
                                                    {{ $row->name }}
                                                </td>
                                                <td>
                                                    {{ $row->email }}

                                                </td>
                                                <td>
                                                    {{ $row->phone }}

                                                </td>

                                                <td class="text-center">
                                                    {{ $row->created_at }}

                                                </td>
                                                <td class="text-center">

                                                    @if ($row->status == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('user.status', ['user' => $row->id]) }}">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('user.status', ['user' => $row->id]) }}">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif

                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('user.show', ['user' => $row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('user.edit', ['user' => $row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('user.delete', ['user' => $row->id]) }}">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('user.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('user.trash') }}">
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
                    <!-- /.card-footer-->
                    <!-- /.card -->
                </section>
            </div>
        </div>
        <!-- Main content -->

        <!-- /.content -->
    </div>

@endsection
