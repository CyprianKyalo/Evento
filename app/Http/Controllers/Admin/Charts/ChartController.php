<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Product;
use App\Models\HiredProduct;
use Backpack\CRUD\app\Library\Widget;



class ChartController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function charts()
    {

        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];

        Widget::add([
            'type'    => 'div',
            'class'   => 'row',
            'content' => [ // widgets 
                [ 
                   'type'       => 'chart',
		            'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,

		            // OPTIONALS

		            'class'   => 'card mb-2',
		            'wrapper' => ['class'=> 'col-md-6'] ,
		            'content' => [
		                 'header' => 'New Monthly Users', 
		                 'body'   => 'This chart should make it obvious how many new users have signed up in the past 30 days.<br><br>',
		            ],
		                    
		        ],

		        [ 
                   'type'       => 'chart',
		            'controller' => \App\Http\Controllers\Admin\Charts\WeeklyProductsChartController::class,

		            // OPTIONALS

		            'class'   => 'card mb-2',
		            'wrapper' => ['class'=> 'col-md-6'] ,
		            'content' => [
		                 'header' => 'New Products', 
		                 'body'   => 'This chart should make it obvious how many new products have been Uploaded.<br><br>',
		            ],
		                    
		        ],

		        [ 
                   'type'       => 'chart',
		            'controller' => \App\Http\Controllers\Admin\Charts\WeeklyHiredProductsChartController::class,

		            // OPTIONALS

		            'class'   => 'card mb-2',
		            'wrapper' => ['class'=> 'col-md-6'] ,
		            'content' => [
		                 'header' => 'Hired Products', 
		                 'body'   => 'This chart should make it obvious how many new products have been Uploaded.<br><br>',
		            ],
		                    
		        ],

		         [ 
                   'type'       => 'chart',
		            'controller' => \App\Http\Controllers\Admin\Charts\ProductsChartController::class,

		            // OPTIONALS

		            'class'   => 'card mb-2',
		            'wrapper' => ['class'=> 'col-md-6'] ,
		            'content' => [
		                 'header' => 'Products', 
		                 'body'   => 'This chart should make it obvious how many new products have been Uploaded.<br><br>',
		            ],
		                    
		        ],

            ]
        ]);


        // Widget::add([ 
        //     'type'       => 'chart',
        //     'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,

        //     // OPTIONALS

        //     'class'   => 'card mb-2',
        //     'wrapper' => ['class'=> 'col-md-6'] ,
        //     'content' => [
        //          'header' => 'New Users', 
        //          'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
        //     ],
        // ]);
        // $users = count(User::all());
        // $products = count(Product::all());
        // $hiredproducts = count(HiredProduct::all());

        // Widget::add([
        //     'type'    => 'div',
        //     'class'   => 'row',
        //     'content' => [ // widgets 
        //         [ 
        //            'type'       => 'progress',

        //             // OPTIONALS

        //             'class'   => 'card text-white bg-info mb-2',
        //             'value'       => $users,
        //             'description' => 'Registered users.',
        //             'progress'    => $users/100 * 100,
        //             // 'hint'        => '8544 more until next milestone.',
                    
        //         ],

        //         [ 
        //             'type'       => 'progress',

        //             // OPTIONALS

        //             'class'   => 'card text-white bg-primary mb-2',
        //             'value'       => $products,
        //             'description' => 'Uploaded products.',
        //             'progress'    => $products/100 * 100,
        //             // 'hint'        => '8544 more until next milestone.',
                    
        //         ],

        //         [ 
        //             'type'       => 'progress',

        //             // OPTIONALS

        //             'class'   => 'card text-white bg-success mb-2',
        //             'value'       => $hiredproducts,
        //             'description' => 'Hired products.',
        //             'progress'    => $hiredproducts/100 * 100,
        //             // 'hint'        => '8544 more until next milestone.',
                    
        //         ],
        //     ]
        // ]);

         
        // return view(backpack_view('dashboard'), $this->data);
        return view('admin.charts', $this->data);
    }

    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    // public function redirect()
    // {
    //     // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
    //     return redirect(backpack_url('dashboard'));
    // }
}
