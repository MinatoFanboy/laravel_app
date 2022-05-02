@extends('admin.main')

@section('content')
    <div class="customer mt-10">
        <ul>
            <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
            <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
            <li>Email: <strong>{{ $customer->email }}</strong></li>
            <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
            <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
        </ul>
    </div>

    <div class="carts">
        <table class="table-shopping-cart">
            <tbody>
            <tr class="table_head">
                <th class="column-1">Product</th>
                <th class="column-2">Tên sản phẩm</th>
                <th class="column-3">Price</th>
                <th class="column-4">Quantity</th>
                <th class="column-5">Total</th>
            </tr>
            @php $total = 0 @endphp

            @foreach ($carts as $cart)
            @php 
                $subtotal = $cart->price * $cart->qty;
                $total += $subtotal;
            @endphp
            <tr class="table_row">
                <td class="column-1">
                    <div class="how-itemcart1">
                        <img src="{{ $cart->product->thumb }}" alt="IMG" width="100px">
                    </div>
                </td>
                <td class="column-2">{{ $cart->product->name }}</td>
                <td class="column-3">{{ $cart->price }}</td>
                <td class="column-3">{{ $cart->qty }}</td>
                <td class="column-5">{{ number_format($subtotal, 0, ',', '.').' VNĐ' }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Tổng tiền</td>
                    <td>{{ number_format($total, 0, ',', '.').' VNĐ' }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection