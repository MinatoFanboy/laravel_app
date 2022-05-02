<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Http\Services\CartService;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart) {
        $this->cart = $cart;
    }

    public function index() {
        return view('admin.carts.customer', ['title' => 'Danh Sách Đơn Đặt Hàng', 'customers' => $this->cart->getCustomer()]);
    }

    public function show(Customer $customer) {
        return view('admin.carts.detail', [
            'title' => 'Chi Tiết Đơn Hàng ' . $customer->name, 
            'customer' => $customer,
            'carts' => $customer->carts->with('products', function($query) {
                $query->select('id', 'name', 'thumb');
            })->get(),
        ]);
    }
}
