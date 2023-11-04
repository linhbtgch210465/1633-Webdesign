<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $menu;
    protected $product;

    public function __construct(MenuService $menu, ProductService $product)
    {
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index()
    {
        return view('viewhome', [
            'title' => 'Zoo BA',
            'menus' => $this->menu->all(true),
            'products' => $this->product->get(),
        ]);
    }

    public function show($id)
    {
        $category = $this->menu->show($id);
        return view('category.show', [
            'title' => 'Zoo Ba',
            'category' => $category,
            'products' => $this->product->get(),
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result])->render();

            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => '']);
    }
}
