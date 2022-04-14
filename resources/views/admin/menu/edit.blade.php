@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="post">
        @include('admin.alert')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" value="{{ $menu->name }}" name="name" id="name" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label for="parent_id">Danh mục</label>
                <select id="parent_id" class="form-control" name="parent_id">
                    <option value="0" {{ $menu->parent_id == 0 ? 'selected' : '' }}>Danh mục cha</option>
                    @foreach($menus as $menuParent)
                        <option value="{{ $menuParent->id }}" {{ $menuParent->id == $menu->parent_id ? 'selected' : '' }}>{{ $menuParent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $menu->content }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{ $menu->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="noactive" name="active" {{ $menu->active == 0 ? 'checked=""' : '' }}>
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

@section('footer')
    <script>
        CKEDITOR.replace('content')
    </script>
@endsection