<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\User;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class WeeklyUsersChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WeeklyUsersChartController extends ChartController
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
        $this->chart->load(backpack_url('charts/weekly-users'));

        // OPTIONAL
        $this->chart->minimalist(false);
        $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        // $users_created_today = \App\Models\User::whereDate('created_at', today())->count();

        // $this->chart->dataset('Users Created', 'bar', [
        //             $users_created_today,
        //         ])
        //     ->color('rgba(205, 32, 31, 1)')
        //     ->backgroundColor('rgba(205, 32, 31, 0.4)');

         for ($days_backwards = 30; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $users[] = User::whereDate('created_at', today()
                ->subDays($days_backwards))
                ->count();
            // $articles[] = Article::whereDate('created_at', today()
            //     ->subDays($days_backwards))
            //     ->count();
            // $categories[] = Category::whereDate('created_at', today()
            //     ->subDays($days_backwards))
            //     ->count();
            // $tags[] = Tag::whereDate('created_at', today()
            //     ->subDays($days_backwards))
            //     ->count();
        }
        $this->chart->dataset('Users', 'line', $users)
            ->color('rgb(77, 189, 116)')
            ->backgroundColor('rgba(77, 189, 116, 0.4)');

    }

    
}