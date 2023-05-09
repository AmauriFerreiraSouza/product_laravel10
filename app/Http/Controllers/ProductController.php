<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        // pego o que vir do meu request no campo SEARCH
        $keyWord = $request->get('search');
        $perPage = 5;//Por página listo cinco produtos

        if (!empty($keyWord)) {
            $products = Product::where('name', 'LIKE', "%$keyWord%")
            ->orWhere('category', 'LIKE', "%$keyWord%")
            ->latest()->paginate($perPage); 
        } else {
            $products = Product::latest()->paginate($perPage);
        }    

        return view('products.index', ['products' => $products])->with('i', (request()->input('page', 1) -1) *5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // $product = new Product;

        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2028'
        ]);

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

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {   

        $request->validate([
            'name' => 'required'
        ]);

        $image_name = $request->hidden_product_image;

        if ($request->image != '') {
            $image_name = time().'.'. request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $image_name);
        }

        $product = Product::find($request->hidden_product_id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $image_name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->update();

        return redirect()->route('products.index')->with('success', 'Produto editado com Sucesso!');
    }
}
