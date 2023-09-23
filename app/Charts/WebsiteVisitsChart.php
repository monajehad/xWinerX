<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Visitor;

class WebsiteVisitsChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
       // Calculate visitor counts by month and year
       $visitorsData = Visitor::selectRaw('YEAR(visited_at) as year, MONTH(visited_at) as month, COUNT(*) as visitor_count')
       ->groupBy('year', 'month')
       ->orderBy('year', 'asc')
       ->orderBy('month', 'asc')
       ->get();

   // Extract unique years and months
   $years = $visitorsData->pluck('year')->unique();
   $months = $visitorsData->pluck('month')->unique();

   // Generate labels for all 12 months
   $allMonths = collect(range(1, 12));

   $this->labels($allMonths->map(function ($month) {
       return date('F', mktime(0, 0, 0, $month, 1));
   }));

   foreach ($years as $year) {
       $visitorCounts = $allMonths->map(function ($month) use ($visitorsData, $year) {
           $data = $visitorsData->where('year', $year)->where('month', $month)->first();
           return $data ? $data->visitor_count : 0;
       });

       $this->dataset("Visitors in $year", 'line', $visitorCounts)->options([
           'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
           'borderColor' => 'rgba(75, 192, 192, 1)',
       ]);
   }
        $this->options([
            'responsive' => true,
            'width' => 400, // Set the width to 400 pixels
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true, // Start at 0
                            'stepSize' => 20,     // Tick interval
                            'max' => 100,         // Maximum tick value
                            
                        ],
                    ],
                ],
            ],
        
        ]);

    //     $this->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May']); // Replace with your data labels

    //     $this->dataset('Website Visits', 'line', [100, 120, 130, 110, 90]); // Replace with your data
    // }

     

    
    }
}
    // 'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], // Replace with your data
