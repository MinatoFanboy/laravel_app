@extends('admin.main')
@include('admin.alert')

@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Tiêu đề</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Tiêu đề">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url">Đường dẫn</label>
                        <input type="text" class="form-control" value="{{ old('url') }}" name="url" id="url" placeholder="Đường dẫn">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sort_by">Sắp xếp</label>
                        <input type="number" class="form-control" value="{{ old('sort_by') }}" name="sort_by" id="sort_by">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="upload">Ảnh sản phẩm</label>
                <input type="file" class="form-control" id="upload">

                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="file">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="noactive" name="active">
                    <label for="noactive" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
        </div>
        @csrf
    </form>
@endsection