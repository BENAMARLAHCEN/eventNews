<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        // Fetch the statistics data
        $statistics = $this->fetchStatistics();

        // Pass the statistics data to the view
        return view('admin.statistics', ['statistics' => $statistics]);
    }

    private function fetchStatistics()
    {
        // Fetch the statistics data from the database
        return [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_categories' => Category::count(),
            'total_reservations' => Reservation::count(),
            'total_revenue' => Reservation::sum('price'),
        ];
    }

    public function organizerStatistic()
    {
        // Fetch the statistics data
        $statistics = $this->fetchOrganizerStatistics();

        // Pass the statistics data to the view
        return view('organizer.statistics', ['statistics' => $statistics]);
    }

    private function fetchOrganizerStatistics()
    {
        // Fetch the statistics data from the database
        return [
            'total_events' => Event::count(),
            'total_reservations' => Reservation::whereIn('event_id', auth()->user()->events->pluck('id'))->count(),
            'total_revenue' => Reservation::whereIn('event_id', auth()->user()->events->pluck('id'))->sum('price'),
        ];
    }
}
