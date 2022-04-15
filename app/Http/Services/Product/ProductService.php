<?php 

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductService {
    public function getMenu() {
        return Menu::where('parent_id', 0)->get();
    }

    protected function isValidPrice($request) {
        if ($request->input('price_sale') != 0 && $request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');

                return false;
        }

        if ($request->input('price') != 0 && $request->input('price_sale') != 0) {
            if ($request->input('price_sale') >= $request->input('price')) {
                Session::flash('error', 'Giảm giả phải nhỏ hơn giá gốc');

                return false;
            }
        }

        return true;
    }

    public function insert($request) {
        $isValidate = $this->isValidPrice($request);
        if ($isValidate == false) return false;

        try {
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Thêm Sản Phẩm Thành Công');
        } catch(\Exception $e) {
            Session::flash('danger', 'Thêm Sản Phẩm Lỗi');
            Log::info($e->getMessage());

            return false;
        }

        return true;
    }
}