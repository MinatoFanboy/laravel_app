<?php 

namespace App\Http\Services\Product;

use App\Models\Menu;

class ProductService {
    public function getMenu() {
        return Menu::where('parent_id', 0)->get();
    }
}