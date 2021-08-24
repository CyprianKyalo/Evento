<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\HiredProduct;
use App\Models\VendorDetails;
use Illuminate\Support\Facades\DB;
use Image;
use App\Notifications\AlertNotification;
use Notification;


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
        $user = User::find(Auth::id());
        // $notifications = new AlertNotification;

        // $notifications = $user->notifications;

        //dd(auth()->user());
        // foreach ($user->notifications as $notification) {
        //     echo $notification->type;
        // }

        // dd($notifications);

        return view('index', compact('user'));
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
            'email' => 'required|email',
            'password' => 'password',
            'profile' => 'mimes:png,jpg,jpeg',
        ]);

        $id = Auth::id();

        $user = User::find($id);

        if($request->has('firstname')) {
            $user->first_name = $request->get('firstname');
        } else {
            $user->first_name = Auth::user()->firstname;
        }

        if($request->has('lastname')) {
            $user->last_name = $request->get('lastname');
        }

        if($request->has('username')) {
            $user->username = $request->get('username');
        }

        if($request->has('email')) {
            $user->email = $request->get('email');
        }

        if($request->has('password')) {
            $pass = $request->get('password');
            $user->password = bcrypt($pass);
        }


        // $user->first_name = $request->get('firstname');
        // $user->last_name = $request->get('lastname');
        // $user->username = $request->get('username');
        // $user->email = $request->get('email');
        // $pass = $request->get('password');
        // $user->password = bcrypt($pass);

        if($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time(). '.' .$profile->getClientOriginalName();
            Image::make($profile)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            
            $user = Auth::user();
            $user->image = $filename;            


            // // $file_name = time().'_'.$request->file('profile')->getClientOriginalName();
            // // $file_path = $request->file('profile')->storeAs('uploads', $file_name, 'public');
            // $user->image = $file_path;
        }

         // $affected = DB::table('users')
         //                        ->where('id', Auth::id())
         //                        ->update(['password' => bcrypt($newpwd)]);


        if($user->save()) {
            return redirect('/view_profile')->with('success', 'User profile updated successfully!');
        } else {
            Session::flash('error', 'There was an problem saving the updated user info to the database. Please Try Again!');

            return redirect()->route('edit_profile', $id);
        }
 
    }

    public function pwd() {
        return view('password_change');
    }

    //Changing passwords
    public function changepwd(Request $request) {
        $this->validate($request, [
            'oldpwd' => 'required',
            'newpwd' => 'required',
            'confpwd' => 'required',
        ]);

        $pwd = Auth::user()->password;
       
        $oldpwd = $request->get('oldpwd');
        $newpwd = $request->get('newpwd');
        $confpwd = $request->get('confpwd');

        if ($newpwd == $confpwd) {
            if (password_verify($request->get('oldpwd'), $pwd)) {

                $affected = DB::table('users')
                                ->where('id', Auth::id())
                                ->update(['password' => bcrypt($newpwd)]);

                if ($affected) {
                     return redirect('/view_profile')->with('success', 'Password changed successfully!');
                } else {
                     return redirect('/pwd')->with('error', 'Something went wrong. Please Try Again!!');
                }

            } else {
                return redirect('/pwd')->with('error', 'Old Password does not match our records. Please input the correct password!!');
            }
        } else {
            return redirect('/pwd')->with('error', 'Your new passwords do not match. Kindly Try Again!!');
        }

        return view('password_change');
    }

    public function activity() {
        // $products = Product::all();
        // $products = DB::table('products')
        //                 ->where('status', '=', 1)
        //                 ->get();

        if (Auth::user()->hasRole('administrator')) {
            // $users = User::all();
            // dd($users);
            // dd(0);
            return redirect('/admin/user_admin');

        } elseif (Auth::user()->hasRole('user')) {


            $products = DB::table('hired_products')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        
                        ->select('products.product_id', 'products.name', 'products.image_path', 'products.description', 'users.image', 'users.id', 'users.username')
                        ->where('hired_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'closed')
                        
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

    //Code to add the vendor details
    public function update_vendor(Request $request) {
        $this->validate($request, [
            'location' => 'required',
            'about_me' => 'required',
            'pnumber' => 'required',
        ]);

        
        $vendordetail = new VendorDetails;

        $vendordetail->user_id = Auth::id();

        $vendordetail->location = $request->get('location');
        $vendordetail->about = $request->get('about_me');
        $vendordetail->pnumber = $request->get('pnumber');

        // dd($vendordetail);

        if($vendordetail->save()) {
            return view('products.create')->with('success', 'Vendor profile updated successfully!');
        } else {
            Session::flash('error', 'There was an problem saving the updated user info to the database. Please Try Again!');

            return redirect()->route('vendor_details');
        }
        
    }

    public function my_products() {       

        $products = DB::table('user_products')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->select('products.product_id', 'products.name', 'products.description', 'products.category', 'products.image_path', 'users.username', 'user_products.price')
                        ->where('products.status', '=', 1)
                        ->where('user_products.user_id', '=', Auth::id())
                        ->orderBy('products.created_at', 'DESC')
                        ->get();


        return view('my_products', compact('products'));
    }

    public function services() {
        $products = DB::table('user_products')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->select('products.product_id', 'products.name', 'products.image_path', 'users.username', 'products.description', 'users.id', 'users.image')
                        ->where('products.status', '=', 1)
                        ->where('products.category', '=', 'service')
                        ->orderBy('products.created_at', 'DESC')
                        ->get();

        return view('services', compact('products'));
    }

    public function vendor_details() {
        return view('vendor_details');
    }

    public function hire(Request $request) {
        $id = $request->get('id');
        $product = Product::find($id);

        $price = DB::table('products')
                    ->join('user_products', 'products.product_id', '=', 'user_products.product_id')
                    ->select('user_products.price')
                    ->where('user_products.product_id', $id)
                    ->value('user_products.price');
        // dd(gettype($price));

        return view('hire', compact('product', 'price'));
    }

    public function hire_product(Request $request) {
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required',
            'duration' => 'required',
            'total_price' => 'required',
            'phone_number' => 'required',
            'location' => 'required',            
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
        $hiredproduct->hired_at = $request->get('start');
        $hiredproduct->duration = $request->get('duration');
        $hiredproduct->hired_ended_at = $request->get('end');
        $hiredproduct->total_price = $request->get('total_price');
        $hiredproduct->location = $request->get('location');
        $hiredproduct->pnumber = $request->get('phone_number');
        $hiredproduct->status = 'pending';

        if ($request->has('other')) {
            $hiredproduct->info = $request->get('other');
        }
       

        if ($hiredproduct->save()) {
            $product = DB::table('products')
                    ->join('hired_products', 'products.product_id', '=', 'hired_products.product_id')
                    
                    ->where('hired_products.product_id', $prod_id)
                    // ->get()
                    // ->latest()->first();
                    ->orderBy('hired_products.created_at', 'DESC')
                
                    ->first();


            // $product = Product::find($product_id);
            // dd($product);

            $id = DB::table('user_products')
                        // ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->select('users.id')
                        ->where('user_products.product_id', '=', $prod_id)
                        ->value('users.id');

        //dd($user);
        // dd($product);

        $user = User::find($id);
        $user->notify(new AlertNotification($product));
        
        return redirect('/activity')->with('success', 'Product hired successfully!');
        } else {
            return redirect('/hire')->with('error', 'There was an error. Please Try Again!');
        }
    }

    public function vendor_profile($id) {
        // $id = $request->get('id');

        $vendor = DB::table('users')
                    ->join('vendor_details', 'users.id', '=', 'vendor_details.user_id')
                    ->where('users.id', $id)
                    ->get();

        
        $product = DB::table('user_products')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->select('products.product_id', 'products.name', 'products.description', 'products.category', 'products.image_path', 'users.username', 'user_products.price')
                        ->where('products.status', '=', 1)
                        ->where('user_products.user_id', '=', $id)
                        ->get();

        $products = DB::table('user_products')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->select('products.product_id', 'products.name', 'products.description', 'products.category', 'products.image_path', 'users.username', 'user_products.price')
                        ->where('products.status', '=', 1)
                        ->where('user_products.user_id', '=', $id)
                        ->take(6)
                        ->get();



        return view('vendor_profile', compact('vendor', 'products', 'product'));
    }

    //Create a notifications function
    public function notifications() {
        auth()->user()->unreadNotifications->markAsRead();

        return view('notifications', [
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }

    public function pending() {
        if (Auth::user()->hasRole('administrator')) {
            $users = User::all();
            // dd($users);
            return view('admin.user_admin.index', compact('users'));

        } elseif (Auth::user()->hasRole('user')) {


            $products = DB::table('hired_products')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        
                        // ->select('products.product_id', 'products.name', 'products.image_path', 'products.description', 'users.image', 'users.id', 'users.username', 'hired_products.duration', 'hired_products.hired_ended_at', 'hired_products.hired_at')
                        ->where('hired_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'pending')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->get();

                        // dd($products);

            return view('items.pending', compact('products'));
        }
    }

    public function accepted() {
        if (Auth::user()->hasRole('administrator')) {
            $users = User::all();
            // dd($users);
            return view('admin.user_admin.index', compact('users'));

        } elseif (Auth::user()->hasRole('user')) {


            $products = DB::table('hired_products')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->join('vendor_details', 'users.id', '=', 'vendor_details.user_id')
                        
                        // ->select('products.product_id', 'products.name', 'products.image_path', 'products.description', 'users.image', 'users.id', 'users.username', 'hired_products.duration', 'hired_products.hired_ended_at', 'hired_products.hired_at')

                        ->where('hired_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'confirmed')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->get();
            // dd($products);

            return view('items.accepted', compact('products'));
        }
    }

    public function declined() {
        if (Auth::user()->hasRole('administrator')) {
            $users = User::all();
            // dd($users);
            return view('admin.user_admin.index', compact('users'));

        } elseif (Auth::user()->hasRole('user')) {


            
            $products = DB::table('hired_products')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        
                        // ->select('products.product_id', 'products.name', 'products.image_path', 'products.description', 'users.image', 'users.id', 'users.username', 'hired_products.hired_at', 'hired_products.duration', 'hired_products.hired_ended_at')
                        ->where('hired_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'declined')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->get();

            return view('items.declined', compact('products'));
        }
    }

    public function cancelled() {
        if (Auth::user()->hasRole('administrator')) {
            $users = User::all();
            // dd($users);
            return view('admin.user_admin.index', compact('users'));

        } elseif (Auth::user()->hasRole('user')) {


            
            $products = DB::table('hired_products')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        
                        // ->select('products.product_id', 'products.name', 'products.image_path', 'products.description', 'users.image', 'users.id', 'users.username', 'hired_products.hired_at', 'hired_products.duration', 'hired_products.hired_ended_at')
                        ->where('hired_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'cancelled')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->get();

            return view('items.cancelled', compact('products'));
        }
    }

    public function history() {
        return view('history');
    }


    //Obtain the products that are hired
    public function products_hired() {
        $products = DB::table('hired_products')
                        ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        ->where('user_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'pending')
                        ->orderBy('hired_products.created_at', 'DESC')
                        // ->paginate(5));
                        ->get();

        // dd($products);
        // return view('hired_products', [
        //     'products' => $products->paginate(5)
        // ]);
        return view('hired_products', compact('products'));
    }


    //Confirm a product is available for hire
    public function confirm($hire_on) {
        // $product = Product::find($id);
        $hiredproduct = new HiredProduct;

        $hiredproduct->status = 'confirmed';

        $affected = DB::table('hired_products')
                        ->where('hired_at', $hire_on)
                        ->update(['status' => 'confirmed']);

        // dd($affected);



        //$product->update('status' => 0);
        if($affected) {

            return redirect()->route('hired_products')->with('success', 'Offer Confirmed successfully!!');
        } else {
            return redirect()->route('hired_products')->with('error', 'There was an error confirming the offer! Please Try Again');
        }
    }

    public function decline($hire_on) {
        // $product = Product::find($id);
        $hiredproduct = new HiredProduct;

        $hiredproduct->status = 'cancelled';

        $affected = DB::table('hired_products')
                        ->where('hired_at', $hire_on)
                        ->update(['status' => 'cancelled']);


        if($affected) {
            return redirect()->route('hired_products')->with('success', 'Offer Declined successfully!!');
        } else {
            return redirect()->route('hired_products')->with('error', 'There was an error declining the offer! Please Try Again');
        }
    }

    public function cancel($hire_on) {
        // $product = Product::find($id);
        $hiredproduct = new HiredProduct;

        $hiredproduct->status = 'cancelled';

        $affected = DB::table('hired_products')
                        ->where('hired_at', $hire_on)
                        ->update(['status' => 'cancelled']);

        // dd($affected);



        //$product->update('status' => 0);
        if($affected) {
            return redirect()->route('pending')->with('success', 'Offer Cancelled successfully!!');
        } else {
            return redirect()->route('pending')->with('error', 'There was an error cancelling the offer! Please Try Again');
        }
    }


    //Closing a product after hire
    public function close($hire_on) {
        // $product = Product::find($id);
        $hiredproduct = new HiredProduct;

        $hiredproduct->status = 'closed';

        $affected = DB::table('hired_products')
                        ->where('hired_at', $hire_on)
                        ->update(['status' => 'closed']);

        // dd($affected);



        //$product->update('status' => 0);
        if($affected) {

            return redirect()->route('hired_products')->with('success', 'Offer Closed successfully!!');
        } else {
            return redirect()->route('hired_products')->with('error', 'There was an error closing the offer! Please Try Again');
        }
    }

    public function hired_accepted() {
        $products = DB::table('hired_products')
                        ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        ->where('user_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'confirmed')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->paginate(5);

        // dd($products);
        // return view('hired_products', [
        //     'products' => $products->paginate(5)
        // ]);
        return view('hired_items.confirmed', compact('products'));
    }

    public function hired_declined() {
        $products = DB::table('hired_products')
                        ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        ->where('user_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'cancelled')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->paginate(5);

        // dd($products);
        // return view('hired_products', [
        //     'products' => $products->paginate(5)
        // ]);
        return view('hired_items.cancelled', compact('products'));
    }

    public function hired_completed() {
        $products = DB::table('hired_products')
                        ->join('user_products', 'hired_products.product_id', '=', 'user_products.product_id')
                        ->join('products', 'hired_products.product_id', '=', 'products.product_id')
                        ->join('users', 'hired_products.user_id', '=', 'users.id')
                        ->where('user_products.user_id', Auth::id())
                        ->where('hired_products.status', '=', 'closed')
                        ->orderBy('hired_products.created_at', 'DESC')
                        ->paginate(5);

        // dd($products);
        // return view('hired_products', [
        //     'products' => $products->paginate(5)
        // ]);
        return view('hired_items.completed', compact('products'));
    }
}
