<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = "Product list from in ProductController";
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // $product = new Product;

        $image_name = time().'.'. request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $image_name);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->image = $image_name;
        // $product->category = $request->category;
        // $product->quantity = $request->quantity;
        // $product->price = $request->price;
        // $product->save();
        return redirect()->route('products.index')->with('success', 'Produto adicionado com Sucesso!');
    }
}
