<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index(Request $request)
    {
        $products = session('products', []); // retrieve products from session
        return view('ProductInfo', compact('products'));
    }

    // Add new product
    public function store(Request $request)
    {
        $products = session('products', []);

        $newProduct = [
            'id' => $request->input('product_id'),
            'name' => $request->input('product_name'),
            'category' => $request->input('product_category'),
            'quantity' => $request->input('product_quantity'),
            'price' => $request->input('product_price'),
        ];

        $products[] = $newProduct;
        session(['products' => $products]);

        return redirect('/products')->with('success', 'Product added successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $products = session('products', []);
        $product = collect($products)->firstWhere('id', $id);

        return view('ProductInfoEdit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $products = session('products', []);

        foreach ($products as &$p) {
            if ($p['id'] == $id) {
                $p['name'] = $request->input('product_name');
                $p['category'] = $request->input('product_category');
                $p['quantity'] = $request->input('product_quantity');
                $p['price'] = $request->input('product_price');
            }
        }

        session(['products' => $products]);
        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $products = session('products', []);
        $products = array_filter($products, fn($p) => $p['id'] != $id);

        session(['products' => $products]);
        return redirect('/products')->with('success', 'Product deleted successfully!');
    }

    // Search product by name
    public function search(Request $request)
    {
        $products = session('products', []);
        $keyword = $request->input('keyword');

        $results = array_filter($products, function ($p) use ($keyword) {
            return stripos($p['name'], $keyword) !== false;
        });

        return view('ProductInfo', ['products' => $results]);
    }
}