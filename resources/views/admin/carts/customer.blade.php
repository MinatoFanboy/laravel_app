@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên khách hàng</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt hàng</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{  $customer->id }}</td>
                    <td>{{  $customer->name }}</td>
                    <td>{{  $customer->phone }}</td>
                    <td>{{  $customer->email }}</td>
                    <td>{{  $customer->address }}</td>
                    <td>{{  $customer->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" onClick="removeRow({{ $customer->id }}, '/admin/customers/destroy')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $customers->links() !!}
    </div>
@endsection