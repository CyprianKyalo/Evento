<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\User;
use App\Models\Product;
use DB;

/**
 * Class ProductsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        // $this->chart->labels([
        //     'Today',
        // ]);
        $labels = array();
        // $names = DB::table('products')->select('name')->get();
        $names = DB::table('products')->select('name')->distinct('name')->get();
        // dd($names);
    
        for ($i=0; $i < count($names); $i++) { 
            $labels[] = $names[$i]->name;
        }

        // dd($labels);

        $this->chart->labels($labels);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/products'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {

        $number = array();
        $count = 0;
        // $names = DB::table('products')->distinct('name')->count('name');
        $names = DB::table('products')->select('name')->get();

    
        for ($i=0; $i < count($names); $i++) { 
            $number[] = $names[$i]->name;
        }


        $number = array_count_values($number);
        $num = array();

        foreach ($number as $key => $value) {
            $num[] = $value;
        }

         $this->chart->dataset('Products', 'pie', $num)
            ->color('rgba(215, 32, 28, 12)')
            ->backgroundColor('rgba(205, 32, 31, 0.4)');
        

    }
}