<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\HiredProduct;
use Illuminate\Support\Facades\DB;
use Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }

    public function view_profile() {
        $id = Auth::id();
        $user = User::find($id);


        return view('view_profile', compact("user"));
    }

    public function edit_profile() {
        $id = Auth::id();
        $user = User::find($id);

        return view('edit_profile', compact('user'));
    }

    public function update_profile(Request $request) {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|max:255',
            'email' => 'required',
            'password' => 'password',
            'profile' => 'mimes:png,jpg,jpeg',
        ]);

        $id = Auth::id();

        $user = User::find($id);
        $user->first_name = $request->get('firstname');
        $user->last_name = $request->get('lastname');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $pass = $request->get('password');
        $user->password = bcrypt($pass);

        if($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time(). '.' .$profile->getClientOriginalName();
            Image::make($profile)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            
            $user = Auth::user();
            // $user->first_name = $request->get('firstname');
            // $user->last_name = $request->get('lastname');
            // $user->username = $request->get('username');
            // $user->email = $request->get('email');
            // $pass = $request->get('password');
            // $user->password = bcrypt($pass);
            $user->image = $filename;            


            // // $file_name = time().'_'.$request->file('profile')->getClientOriginalName();
            // // $file_path = $request->file('profile')->storeAs('uploads', $file_name, 'public');
            // $user->image = $file_path;
        }

        if($user->save()) {
            return redirect('/view_profile')->with('success', 'User profile updated successfully!');
        } else {
            Session::flash('error', 'There was an problem saving the updated user info to the database. Please Try Again!');

            return redirect()->route('edit_profile', $id);
        }
 
    }

    public function activity() {
        // $products = Product::all();
        // $products = DB::table('products')
        //                 ->where('status', '=', 1)
        //                 ->get();

        if (Auth::user()->hasRole('administrator')) {
            $users = User::all();
            // dd($users);
            return view('admin.user_admin.index', compact('users'));

        } elseif (Auth::user()->hasRole('user')) {
            // $user_id = Auth::id();

            // $product_id = DB::table('hired_products')
            //             ->select('product_id')
            //             ->where('user_id', $user_id)
            //             ->where('status', 'ongoing')
            //             ->value('product_id');

            // $products = Product::find($product_id);

            // $user_id = DB::table('user_products')
            //             ->select('user_id')
            //             ->where('product_id', $product_id)
            //             ->value('user_id');

            // $username = DB::table('users') 
            //                 ->select('username')
            //                 ->where('id', $user_id)
            //                 ->where('username');

            // dd($products, $product_id, $user_id, $username);


            $products = DB::table('hired_products')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        
                        ->select('products.product_id', 'products.name', 'products.image_path')
                        ->where('hired_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'ongoing')
                        
                        ->get();

              // dd($products);
            // $username = array();

            // foreach ($products as $product) {
            //     $product_id = $product->product_id;

            //     $username[] = DB::table('user_products')
            //                 ->join('products', 'user_products.product_id', '=', 'products.product_id')
            //                 ->join('users', 'user_products.user_id', '=', 'users.id')
            //                 ->select('users.username')
            //                 ->where('products.product_id', $product_id)
            //                 ->get();
            // }

            

            // dd($username);

            return view('activity', compact('products'));
        }

        
    }

    public function my_products() {       

        $products = DB::table('user_products')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->select('products.product_id', 'products.name', 'products.description', 'products.category', 'products.image_path', 'users.username', 'user_products.price')
                        ->where('products.status', '=', 1)
                        ->where('user_products.user_id', '=', Auth::id())
                        ->get();

        return view('my_products', compact('products'));
    }

    public function services() {
        $products = DB::table('user_products')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->select('products.product_id', 'products.name', 'products.image_path', 'users.username')
                        ->where('products.status', '=', 1)
                        ->where('products.category', '=', 'service')
                        ->get();

        return view('services', compact('products'));
    }

    public function vendor() {
        return view('vendor');
    }

    public function hire(Request $request) {
        $id = $request->get('id');
        $product = Product::find($id);

        return view('hire', compact('product'));
    }

    public function hire_product(Request $request) {
        $this->validate($request, [
            'date_of_hire' => 'required',
            'duration' => 'required',
        ]);

        $user_id = Auth::id();
        $id = $request->get('id');
        $prod_id = DB::table('products')
                            ->select('product_id')
                            ->where('product_id', $id)
                            ->value('prod_id');


        $hiredproduct = new HiredProduct;
        $hiredproduct->user_id = $user_id;
        $hiredproduct->product_id = $prod_id;
        $hiredproduct->hired_at = $request->get('date_of_hire');
        $hiredproduct->duration = $request->get('duration');
        $hiredproduct->status = 'ongoing';

        if ($hiredproduct->save()) {
            return redirect('/activity')->with('success', 'Product hired successfully!');
        } else {
            return redirect('/hire')->with('error', 'There was an error. Please Try Again!');
        }
    }
}
