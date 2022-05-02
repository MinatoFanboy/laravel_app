<?php 

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SliderService {
    public function show() {
        return Slider::orderByDesc('id')->get();
    }

    public function get() {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function insert($request) {
        try {
            $request->except('_token');
            Slider::create($request->all());

            Session::flash('success', 'Thêm Slider Thành Công');
        } catch(\Exception $e) {
            Session::flash('danger', 'Thêm Slider Lỗi');
            Log::info($e->getMessage());

            return false;
        }

        return true;
    }

    public function update($request, $slider) {
        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($e->getMessage());

            return false;
        }

        return true;
    }

    public function delete($request) {
        $product = Slider::where('id', $request->input('id'))->first();

        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }
}