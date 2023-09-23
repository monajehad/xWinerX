<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class ContinentPieChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

          // Calculate visitor counts by continent
          $continentCounts = DB::table('visitors')
          ->select('continent', DB::raw('COUNT(*) as count'))
          ->groupBy('continent')
          ->get();

      // Extract the continent names and visitor counts
    //   $continentLabels = $continentCounts->pluck('continent');
      $visitorCounts = $continentCounts->pluck('count');
      $continentLabels = ['America','Africa','Asia', 'Europe',];
// Define custom colors for each continent
$colors = ['#007DFE', '#FFAB00', '#FF5630', '#00B8D9']; // Add more colors as needed

      // Set labels and dataset for the pie chart
      $this->labels($continentLabels);
      $this->dataset('Visitor Count by Continent', 'pie', $visitorCounts) ->backgroundColor($colors);;
  
      // Set the width and height of the chart
      $this->options([
        'responsive' => true,
        'width' => 300, // Set the desired width in pixels
        'height' => 300, // Set the desired height in pixels
    ]);

    }
}
