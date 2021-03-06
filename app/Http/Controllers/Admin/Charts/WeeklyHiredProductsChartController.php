<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\HiredProduct;

/**
 * Class WeeklyHiredProductsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WeeklyHiredProductsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        // $this->chart->labels([
        //     'Today',
        // ]);
        $labels = [];
        for ($days_backwards = 30; $days_backwards >= 0; $days_backwards--) {
            if ($days_backwards == 1) {
            }
            $labels[] = $days_backwards.' days ago';
        }
        $this->chart->labels($labels);


        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/weekly-hired-products'));

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
        for ($days_backwards = 30; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $products[] = HiredProduct::whereDate('created_at', today()
                ->subDays($days_backwards))
                ->count();
        }

        $this->chart->dataset('Products', 'bar', $products)
            ->color('rgba(205, 32, 31, 1)')
            ->backgroundColor('rgba(205, 32, 31, 0.4)');

    }
}