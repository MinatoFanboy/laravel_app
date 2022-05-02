<?php

namespace App\Http\Controllers;
use App\Http\Services\Menu\MenuService;

use Illuminate\Http\Request;

class MenuController
{
    protected $menu;

    public function __construct(MenuService $menu) {
        $this->menu = $menu;
    }

    public function index(Request $request, $id, $slug = '') {
        $menu = $this->menu->getId($id);
        $products = $this->menu->getProduct($menu, $request);
        
        return view('menu', ['title' => $menu->name, 'products' => $products, 'menu' => $menu]);
    }
}
