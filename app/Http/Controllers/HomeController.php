<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|max:255',
            'email' => 'required',
            'profile' => 'mimes:png,jpg,jpeg'
        ]);

        $id = Auth::id();

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $pass = $request->get('password');
        $user->password = bcrypt($pass);

        if($request->file('profile')) {
            $file_name = time().'_'.$request->file('profile')->getClientOriginalName();
            $file_path = $request->file('profile')->storeAs('uploads', $file_name, 'public');
            $user->image = $file_path;
        }

        if($user->save()) {
            return redirect('/view_profile')->with('success', 'User profile updated successfully!');
        } else {
            Session::flash('error', 'There was an problem saving the updated user info to the database. Please Try Again!');

            return redirect()->route('edit_profile', $id);
        }

    }

    public function activity() {
        $products = Product::all();


        return view('activity', compact('products'));
    }

    public function my_products() {
        //$products = Product::all();

        $products = DB::table('products')
                        ->where('status', '=', 1)
                        ->get();

        return view('my_products', compact('products'));
    }

    public function services() {
        return view('services');
    }

    public function vendor() {
        return view('vendor');
    }
}
