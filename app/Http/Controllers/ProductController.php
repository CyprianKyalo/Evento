<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = DB::table('products')
                        ->where('status', '=', 1)
                        ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // 'item-image' => 'mimes:png,jpg,jpeg',
        ]);

        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = 40;
        $product->status = 1;

        if($request->file('item-image')) {
            $file_name = time().'_'.$request->file('item-image')->getClientOriginalName();
            $file_path = $request->file('item-image')->storeAs('uploads', $file_name, 'public');

            $product->image = $file_path;
        }

        $product->save();
        
        return redirect()->route('my_products')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        // //$product = DB::table('products')
        //                 ->where('status', 1)
        //                 ->get();

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);

        $product->update($request->all());

        // $product = Product::find($id);

        // $product->name = $request->name;
        // $product->description = $request->description;

        // $product->update(['name' => $request->name]);
        // $product->update(['description' => $request->description]);

        // $product->update();
        return redirect()->route('my_products')->with('success', 'Product updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$product = Product::find($id);

        //$product->update('status' => 0);
        $product = DB::table('products')
                        ->where('id', '=', $id)
                        ->update(['status' => 0]);

        return redirect()->route('my_products')->with('success', 'Product Deleted successfully!');
    }
}
