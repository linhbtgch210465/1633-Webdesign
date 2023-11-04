<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        $product = $this->productService->show($id);
        $products = $this->productService->more($id);
        return view('products.content', compact('product', 'products'));
    }
}
