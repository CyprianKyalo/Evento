<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // public function personal_details($id) {
    //     //$users = User::findOrFail($id);

    //     return view('profile');
    // }

    public function activity() {
        return view('activity');
    }

    public function equipment() {
        return view('equipment');
    }

    public function services() {
        return view('services');
    }

    public function vendor() {
        return view('vendor');
    }

    public function description() {
        return view('description');
    }
}
