@extends('layouts.backend.admin')
@section('title', $title ?? 'Trang Quản Lý')
@section('content')
    @endphp
    @endphp
    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CHI TIẾT THƯƠNG HIỆU</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <div class="row">
                <div class="col-5">
                    <section class="content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('brand.edit', ['brand' => $row->id]) }}"
                                        class="btn btn-sm btn-success"><i class="fas fa-edit"></i>Sửa</a>

                                    <a href="{{ route('brand.index') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-undo-alt"></i>Quay về danh sách</a>
                                    <a href="{{ route('brand.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>Xóa</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered border-primary table-hover ">
                                <thead class="bg-success">
                                    <tr class="fs-1">
                                        <th width="30%">
                                            TÊN TRƯỜNG
                                        </th>
                                        <th>
                                            GÁI TRỊ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $row->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>TÊN THƯƠNG HIỆU</th>
                                        <td>{{ $row->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>SLUG</th>
                                        <td>{{ $row->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>THỨ TỰ</th>
                                        <td>{{ $row->sord_order }}</td>
                                    </tr>
                                    <tr>
                                        <th>MÃ CẤP CHA</th>
                                        <td>{{ $row->parent_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>LEVEL</th>
                                        <td>{{ $row->level }}</td>
                                    </tr>
                                    <tr>
                                        <th>HÌNH ẢNH</th>
                                        <td class="index-img">
                                            <img src="{{ asset('images/brand/' . $row->image) }}" class="img-fluid"
                                                alt="{{ $row->image }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TỪ KHÓA TÌM KIẾM</th>
                                        <td>{{ $row->metakey }}</td>
                                    </tr>
                                    <tr>
                                        <th>MÔ TẢ</th>
                                        <td>{{ $row->metadesc }}</td>
                                    </tr>
                                    <tr>
                                        <th>NGÀY TẠO</th>
                                        <td>{{ $row->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>NGƯỜI TẠO</th>
                                        <td>{{ $row->created_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>NGÀY SỬA CUỐI</th>
                                        <td>{{ $row->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>NGƯỜI SỬA CUỐI</th>
                                        <td>{{ $row->updated_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>TRẠNG THÁI</th>
                                        <td>{{ $row->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <div class="col-7">
                    <div class="card-body">
                        @includeIf('backend.message')
                        <table class="table table-bordered table-striped " id="dataTable">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" style="width:20px;"><input type="checkbox" name="checkId[]  ">
                                    </th>
                                    <th>TÊN THƯƠNG HIỆU</th>
                                    <th style="width:100px">HÌNH ĐẠI DIỆN</th>
                                    <th>NGÀY TẠO</th>
                                    <th>CHỨC NĂNG</th>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                    <tr>
                                        <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                                        <td>{{ $row->name }}</td>
                                        <td><img src="{{ asset('images/brand/' . $row->image) }}" class="img-fluid"
                                                alt="{{ $row->image }}"></td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            @if ($row->status == 2)
                                                <a href="{{ route('brand.status', ['brand' => $row->id]) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-toggle-on"></i></a>
                                            @else
                                                <a href="{{ route('brand.status', ['brand' => $row->id]) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-toggle-off"></i></a>
                                            @endif
                                            <a href="{{ route('brand.edit', ['brand' => $row->id]) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-wrench"></i></a>
                                            <a href="{{ route('brand.show', ['brand' => $row->id]) }}"
                                                class="btn btn-sm btn-primary "><i class="far fa-eye"></i></a>

                                            <a href="{{ route('brand.delete', ['brand' => $row->id]) }}"
                                                class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
                                        </td>
                                        <td>{{ $row->id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        </section>
        <!-- /.content -->
        </div>
    </form>
@endsection
