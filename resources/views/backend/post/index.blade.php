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
                    <form action="{{ route('post.store') }}" name="form1" method="post" enctype="multipart/form-data">
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
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">Chính</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="content-tab" data-bs-toggle="tab"
                                            data-bs-target="#content" type="button" role="tab" aria-controls="content"
                                            aria-selected="false">Nội
                                            Dung</button>
                                    </li>
                                </ul>
                                <div class="tab-content p-3  border-right border-left border-bottom" id="myTabContent">
                                    <div class="tab-pane fade show active " id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <label for="title">Tên bài viết</label>
                                                    <input type="text" name="title" id="title" class="form-control"
                                                        placeholder="Chính sách bảo hành" value="{{ old('title') }}">
                                                    @if ($errors->has('title'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('title') }}
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
                                                <div class="mb-3">
                                                    <label for="topic_id">Chủ đề</label>
                                                    <select name="topic_id" id="topic_id" class="form-control">
                                                        <option value="">--chon chủ đề--</option>
                                                        {!! $html_topic_id !!}
                                                    </select>
                                                    @if ($errors->has('topic_id'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('topic_id') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <label for="image">Hình đại diện</label>
                                                    <input type="file" name="image" id="image" class="form-control"
                                                        value="{{ old('image') }}">
                                                    @if ($errors->has('image'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('image') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <label for="status">Trạng thái</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1"
                                                            {{ old('status') == 1 ? 'selected' : ' ' }}>
                                                            Xuất bản
                                                        </option>
                                                        <option value="2"
                                                            {{ old('status') == 2 ? 'selected' : ' ' }}>
                                                            Không
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
                                                placeholder="Chi tiết">{{ old('detail') }}</textarea>
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
                                            <i class="fas fa-save"></i> Lưu[Thêm]
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <div class="col-7">
                    <form action="{{ route('post.delete_multi') }}" name="form1" method="post">
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
                                           
                                            <a class="btn btn-sm btn-danger" href="{{ route('post.trash') }}">
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
                                            <th class="text-center" style="width:25%">Tiêu đề bài viết</th>
                                            <th class="text-center">Chủ đề</th>
                                            <th class="text-center" style="width:20%">Ngày tạo</th>
                                            <th class="text-center" style="width:20%">Chức năng</th>
                                            <th class="text-center" style="width:5%">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $row)
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
                                                    {{ $row->topic_name }}

                                                </td>
                                                <td class="text-center">
                                                    {{ $row->created_at }}

                                                </td>
                                                <td class="text-center">

                                                    @if ($row->status == 1)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('post.status', ['post' => $row->id]) }}">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('post.status', ['post' => $row->id]) }}">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif

                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('post.show', ['post' => $row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('post.edit', ['post' => $row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('post.delete', ['post' => $row->id]) }}">
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
                                            
                                            <a class="btn btn-sm btn-danger" href="{{ route('post.trash') }}">
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
