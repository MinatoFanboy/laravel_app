<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductMainService;

class ProductController
{
    protected $product;

    public function __construct(ProductMainService $product) {
        $this->product = $product;
    }

    public function index($id, $slug = '') {
        $product = $this->product->show($id);
        $productMore = $this->product->more($id);

        return view('products.content', ['title' => $product->name, 'product' => $product, 'productMore' => $productMore]);
    }
}
