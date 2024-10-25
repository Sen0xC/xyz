<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Track;

class WeekController extends Controller
{
    /**
     * Redirect to current week.
     */
    public function index()
    {
        return redirect()->route('app.weeks.show', [
            'week' => Week::current()
        ]);
    }

    /**
     * Show the given week.
     */
    public function show(Week $week)
    {
        $tracks = Track::with(['category', 'user'])->currentWeek()->ranking()->get();

        return view('app.weeks.show', [
            'week' => $week->loadCount('tracks'),
            'isCurrent' => $week->toPeriod()->contains(now()),
            'tracks' => $tracks
        ]);
    }
}
