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
        <div class="row">
            <div class="col-5">
                <section class="content">
                    <form action="{{ route('customer.store') }}" name="form1" method="post"
                        enctype="multipart/form-data">
                        <!-- Default box --> @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i> Lưu[Thêm]
                                        </button>
                                        <a class="btn btn-sm btn-info" href="{{ route('customer.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @includeIf('backend.message_alert')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username">Tên tài khoản</label>
                                            <input name="username" id="username" type="text" class="form-control "
                                                placeholder="vd:xyz123" value="{{ old('username') }}">
                                            @if ($errors->has('username'))
                                                <div class="text-danger">
                                                    {{ $errors->first('username') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="password">Mật khẩu</label>
                                            <div class="input-group mb-3">

                                                <input name="password" id="password" type="password" class="form-control "
                                                    value="{{ old('password') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" onclick="myFunction2();">
                                                        <i class="fas fa-eye" id="show_eye2"></i>
                                                        <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                                                    </span>
                                                </div>

                                            </div>
                                            @if ($errors->has('password'))
                                                <div class="text-danger">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif

                                        </div>

                                        <div class="">
                                            <label for="password_re">Nhập lại mật khẩu</label>

                                            <div class="input-group mb-3">

                                                <input name="password_re" id="password_re" type="password"
                                                    class="form-control " value="{{ old('password_re') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" onclick="myFunction();">
                                                        <i class="fas fa-eye" id="show_eye"></i>
                                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                    </span>
                                                </div>

                                            </div>
                                            @if ($errors->has('password_re'))
                                                <div class="text-danger">
                                                    {{ $errors->first('password_re') }}
                                                </div>
                                            @endif
                                        </div>



                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input name="email" id="email" type="text" class="form-control "
                                                placeholder="vd: xyz@gmail.com" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <div class="text-danger">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone">Điện thoại</label>
                                            <input name="phone" id="phone" type="tel" class="form-control "
                                                placeholder="0123456789" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <div class="text-danger">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name">Họ&tên</label>
                                            <input name="name" id="name" type="text" class="form-control "
                                                placeholder="" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label>Giới tính</label><br>
                                            <input type="radio" name="gender" id="nam" value="0"
                                                {{ old('gender') == 0 ? 'checked' : ' ' }}><label
                                                for="nam">Nam</label>
                                            <input type="radio" name="gender" id="nu" value="1"
                                                {{ old('gender') == 1 ? 'checked' : ' ' }}><label
                                                for="nu">Nữ</label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address">Địa chỉ</label>
                                            <input name="address" id="address" type="text" class="form-control "
                                                placeholder="" value="{{ old('address') }}">
                                            @if ($errors->has('address'))
                                                <div class="text-danger">
                                                    {{ $errors->first('address') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="image">Hình đại diện</label>
                                            <input name="image" id="image" type="file"
                                                class="form-control btn-sm" value="{{ old('image') }}">
                                            @if ($errors->has('image'))
                                                <div class="text-danger">
                                                    {{ $errors->first('image') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Trạng thái</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" {{ old('status') == 1 ? 'selected' : ' ' }}>Xuất
                                                    bản
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
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i> Lưu[Thêm]
                                        </button>
                                        <a class="btn btn-sm btn-info" href="{{ route('customer.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                        </a>
                                    </div>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </section>
            </div>
            <div class="col-7">
                <section class="content">

                    <!-- Default box -->
                    <form action="{{ route('customer.delete_multi') }}" name="form1" method="post">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('customer.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('customer.trash') }}">
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
                                            {{-- <th class="text-center" style="width:15%">Email</th> --}}
                                            <th class="text-center" style="width:10%">Phone</th>
                                            <th class="text-center" style="width:15%">Ngày tạo</th>
                                            <th style="width:20%" class="text-center">Chức năng</th>
                                            <th class="text-center" style="width:5%">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer as $row)
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
                                                {{-- <td>
                                                    {{ $row->email }}

                                                </td> --}}
                                                <td>
                                                    {{ $row->phone }}

                                                </td>

                                                <td class="text-center">
                                                    {{ $row->created_at }}

                                                </td>
                                                <td class="text-center">

                                                    @if ($row->status == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('customer.status', ['customer' => $row->id]) }}">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('customer.status', ['customer' => $row->id]) }}">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif

                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('customer.show', ['customer' => $row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('customer.edit', ['customer' => $row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('customer.delete', ['customer' => $row->id]) }}">
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
