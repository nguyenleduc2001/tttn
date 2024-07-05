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
                            <li class="breadcrumb-item"><a href="{{ route('topic.index') }}"
                                    style="text-transform: capitalize;">Tất cả chủ đề</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        </section>

        <section class="content">
            <div class="row">
                <div class="col-5"> <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('topic.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('topic.edit', ['topic' => $topic->id]) }} ">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('topic.delete', ['topic' => $topic->id]) }}">
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
                                <td>{{ $topic->id }}</td>
                            </tr>
                            <tr>
                                <th>Tên Danh Mục</th>
                                <td>{{ $topic->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $topic->slug }}</td>
                            </tr>

                            <tr>
                                <th>Cấp cha</th>
                                <td>{{ $topic->parent_id }}</td>
                            </tr>
                            <tr>
                                <th>Sắp xếp</th>
                                <td>{{ $topic->sort_order }}</td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td>{{ $topic->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td>{{ $topic->created_by }}</td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td>{{ $topic->updated_at }}</td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td>{{ $topic->updated_by }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>{{ $topic->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('topic.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('topic.edit', ['topic' => $topic->id]) }} ">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('topic.delete', ['topic' => $topic->id]) }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div></div>
                <div class="col-7">  <form action="{{ route('topic.delete_multi') }}" name="form1" method="post">
                        @csrf
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
                                            <a class="btn btn-sm btn-success" href="{{ route('topic.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('topic.trash') }}">
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

                                            <th style="width: 25%;">Chủ đề</th>
                                            <th class="text-center" style="width: 25%;">Slug</th>
                                            <th class="text-center" style="width: 20%;"> Ngày Tạo</th>
                                            <th class="text-center" style="width: 20%;">Chức Năng</th>
                                            <th class="text-center" style="width: 5%;">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topicshow as $row)   
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
                                                    {{ $row->slug }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $row->created_at }}

                                                </td>
                                                <td class="text-center">

                                                    @if ($row->status == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('topic.status', ['topic' => $row->id]) }}">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('topic.status', ['topic' => $row->id]) }}">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif

                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('topic.show', ['topic' => $row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('topic.edit', ['topic' => $row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('topic.delete', ['topic' => $row->id]) }}">
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
                                            <a class="btn btn-sm btn-success" href="{{ route('topic.create') }}">
                                                <i class="fas fa-plus"></i> Thêm
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('topic.trash') }}">
                                                <i class="fas fa-trash"></i> Thùng rác
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </form></div>
            </div>
            <!-- Default box -->
           
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

@endsection
