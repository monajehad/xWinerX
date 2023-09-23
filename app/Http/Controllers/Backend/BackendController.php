<?php

namespace App\Http\Controllers\Backend;

use App\Charts\ContinentPieChart;
use App\Charts\WebsiteVisitsChart;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Userprofile;
use Carbon\Carbon;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

// Calculate the start and end of the current week
$startDate = Carbon::now()->startOfWeek();
$endDate = Carbon::now()->endOfWeek();

// Query the database to count new users within the current week
$currentWeekNewUsers = User::whereBetween('created_at', [$startDate, $endDate])
    ->count();

   // Calculate the start and end dates for the last week
   $startDatee = Carbon::now()->startOfWeek();
   $endDatee = Carbon::now()->endOfWeek();

   // Query the users table to count users who were active within the last week
   $dailyActiveUsersCount = Userprofile::whereBetween('last_login', [$startDatee, $endDatee])
   ->count();

  // Count closed campaigns with the specified statuses within the last week
$closedCampaignsCount = Campaign::where(function ($query) {
    $query->where('status', 'Won the Prize')
        ->orWhere('status', 'Disabled by Admin');
})
->whereBetween('updated_at', [$startDate, $endDate])
->count();
$activeCampaignsCount= Campaign::where('status', 'Active')
->whereBetween('created_at', [$startDate, $endDate])

->count();

$newCampaignsCount = Campaign::whereBetween('created_at', [$startDate, $endDate])->count();


$chart = new WebsiteVisitsChart();

$chartPie = new ContinentPieChart();
$campaigns = Campaign::all();

return view('backend.index', compact(
    'currentWeekNewUsers',
    'dailyActiveUsersCount',
    'closedCampaignsCount',
    'activeCampaignsCount',
    'newCampaignsCount',
    'chart',
    'chartPie',
    'campaigns'
));
    }
}
