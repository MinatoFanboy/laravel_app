<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService) {
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        return view('admin.slider.list', [
            'title' => 'Danh Sách Slider',
            'sliders' => $this->sliderService->get(),
        ]);
    }

    public function create()
    {
        return view('admin.slider.add', [
            'title' => 'Thêm Slider Mới',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required',
        ]);

        $this->sliderService->insert($request);

        return redirect()->back();
    }

    public function show(Slider $slider)
    {
        return view ('admin.slider.edit', [
            'title' => 'Cập nhật Slider',
            'slider' => $slider,
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required',
        ]);

        $result = $this->sliderService->update($request, $slider);
        if ($result) {
            return redirect('/admin/sliders/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->sliderService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công slider',
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
