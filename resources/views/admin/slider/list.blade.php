@extends('admin.main')

@section('content')
    @include('admin.alert')
    
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->url }}</td>
                    <td><a href="{{ $slider->thumb }}" target="_blank"><img src="{{ $slider->thumb }}" alt="Ảnh thay thế" width="100px"></a></td>
                    <td>{!!  \App\Helpers\Helper::active($slider->active) !!}</td>
                    <td>{{  $slider->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onClick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection