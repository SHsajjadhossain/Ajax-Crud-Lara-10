<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products() {
        $products = Product::orderBy('created_at', 'desc')->paginate('5');
        return view('products', compact('products'));
    }

    // product create

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    // product update

    public function update(Request $request){
        $request->validate([
            'up_name' => 'required',
            'up_price' => 'required',
        ]);

        Product::where('id', $request->up_id)->update([
            'name' => $request->up_name,
            'price' => $request->up_price
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    // delete product

    public function delete(Request $request){
        Product::find($request->product_id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
