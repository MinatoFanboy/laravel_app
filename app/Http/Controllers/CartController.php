<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartController
{
    protected $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    public function index(Request $request) {
        $result = $this->cartService->create($request);

        if ($result === false) {
            return redirect()->back();
        }
        return redirect('/carts.html');
    }

    public function show() {
        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ hàng', 
            'products' => $products,
            'carts' => Session::get('carts'),
        ]);
    }

    public function update(Request $request) {
        $this->cartService->update($request);

        return redirect('/carts.html');
    }

    public function remove($id = 0) {
        $this->cartService->remove($id);

        return redirect('/carts.html');
    }

    public function addCart(Request $request) {
        $result = $this->cartService->addCart($request);

        if ($result) {
            return redirect()->back();
        }
    }
}
