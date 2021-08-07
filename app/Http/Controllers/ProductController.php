<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;


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
        // $products = DB::table('products')
        //                 ->where('status', '=', 1)
        //                 ->get();

        // $products = Product::with('user')
        //                 ->where('products.status', '=', 1)
        //                 ->where('products.category', '=', 'equipment')
        //                 ->get();

        $products = DB::table('user_products')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->select('products.product_id', 'products.name', 'products.image_path', 'users.username')
                        ->where('products.status', '=', 1)
                        ->where('products.category', '=', 'equipment')
                        ->get();

        //dd($products);

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
            'category' => 'required',
            'item-image' => 'mimes:png,jpg,jpeg',
            'price' => 'required',
            'status' => 'required',
        ]);

        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->status = 1;
        $product->category = $request->category;

        if($request->hasFile('item-image')) {
            $itemImage = $request->file('item-image');
            $filename = time(). '.' .$itemImage->getClientOriginalName();
            Image::make($itemImage)->resize(300, 300)->save(public_path('/uploads/products/' . $filename));
            
            $product->image_path = $filename;        
        }

        if($product->save()) {
            $product_id = DB::table('products')
                            ->select('product_id')
                            ->where('created_at', NOW())
                            ->value('product_id');

            $userProduct = new UserProduct;
            $userProduct->user_id = Auth::id();
            $userProduct->product_id = $product_id;
            $userProduct->price = $request->price;
            $userProduct->status = $request->status;

            $userProduct->save();
            
            return redirect()->route('my_products')->with('success', 'Product created successfully!');   
        } else {
            return redirect()->route('my_products')->with('error', 'There was an error uploading the product. Please Try Again!');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);

        $user_id = DB::table('user_products')
                        ->select('user_id')
                        ->where('product_id', $product_id)
                        ->value('user_id');

        $price = DB::table('user_products')
                        ->select('price')
                        ->where('product_id', $product_id)
                        ->value('price');

        $username = DB::table('users')
                        ->select('username')
                        ->where('id', $user_id)
                        ->value('username');

        // $product = DB::table('user_products')
        //                 ->join('products', 'user_products.product_id', '=', 'products.product_id')
        //                 ->join('users', 'user_products.user_id', '=', 'users.id')
        //                 ->select('products.product_id', 'products.name', 'products.description', 'users.username')
                        
        //                 ->get();
        

        return view('products.show', compact('product', 'username', 'price'));
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

        $price = DB::table('user_products')
                        ->select('price')
                        ->where('product_id', $id)
                        ->value('price');
        
        return view('products.edit', compact('product', 'price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'item-image' => 'mimes:png,jpg,jpeg',
            'price' => 'required',
            'status' => 'required',

        ]);

        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->description = $request->get('description');


        if($request->hasFile('item-image')) {
            $itemImage = $request->file('item-image');
            $filename = time(). '.' .$itemImage->getClientOriginalName();
            Image::make($itemImage)->resize(300, 300)->save(public_path('/uploads/products/' . $filename));
            
            $product->image_path = $filename;        
        }

        if($product->save()) {
            DB::table('user_products')
                        ->where('product_id', $id)
                        ->update([
                            'price' => $request->price,
                            'status' => $request->status]);


            return redirect('/my_products')->with('success', 'Product updated successfully!');
        } else {
            Session::flash('error', 'There was an problem saving the updated user info to the database. Please Try Again!');

            return redirect()->route('/products.edit', $id);
        }

        // $product->update($request->all());

        // // $product = Product::find($id);

        // // $product->name = $request->name;
        // // $product->description = $request->description;

        // // $product->update(['name' => $request->name]);
        // // $product->update(['description' => $request->description]);

        // // $product->update();
        // return redirect()->route('my_products')->with('success', 'Product updated successfully!');

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
                        ->where('product_id', '=', $id)
                        ->update(['status' => 0]);

        return redirect()->route('my_products')->with('success', 'Product Deleted successfully!');
    }
}
