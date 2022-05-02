<?php 

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductMainService {
    const LIMIT = 16;

    public function get($page = null) {
        return Product::select(['id', 'name', 'price', 'price_sale', 'thumb'])
        ->orderByDesc('id')->limit(self::LIMIT)
        ->when($page != null, function($query) use ($page) {
            $query->offset(self::LIMIT * intval($page));
        })
        ->get();
    }

    public function show($id) {
        return Product::select(['id', 'name', 'price', 'price_sale', 'thumb', 'menu_id', 'description', 'content'])
            ->with('menu')->where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function more($id) {
        return Product::select(['id', 'name', 'price', 'price_sale', 'thumb', 'menu_id', 'description', 'content'])
            ->where('id', '!=', $id)->where('active', 1)->limit(8)->orderByDesc('id')->get();
    }
}