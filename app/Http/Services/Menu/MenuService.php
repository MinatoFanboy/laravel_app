<?php 

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuService {
    // public function get($parent_id = 1) {
    //     return Menu::when($parent_id == 0, function($query) use ($parent_id) {
    //         return $query->where($parent_id, $parent_id);
    //     })->get();
    // }

    public function show() {
        return Menu::select('name', 'id')->limit(3)->
            where('parent_id', 0)->orderByDesc('id')->get();
    }

    public function getAll() {
        return Menu::orderByDesc('id')->paginate(20);
    }

    public function getParent() {
        return Menu::where('parent_id', 0)->get();
    }

    public function create($request) {
        try {
            Menu::updateOrCreate([
                'name' => (string) $request->input('name'),
            ],
            [
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        } 

        return true;
    }

    public function update($request, $menu): bool {
        if ((int) $request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }
        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (int) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật Danh Mục Thành Công');

        return true;
    }

    public function destroy($request) {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();

        if ($menu) {
            return Menu::where('id', $menu->id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function getId($id) {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request) {
        $query = $menu->products()->select('id', 'name', 'price', 'price_sale', 'thumb')->where('active', 1);
        
        if ($request->input('price')) {
            $query->orderByDesc('price', $request->input('price'));
        } else {
            $query->orderByDesc('id');
        }
        
        return $query->paginate(12)->withQueryString();
    }
}