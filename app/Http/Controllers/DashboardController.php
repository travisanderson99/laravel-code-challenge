<?php

namespace App\Http\Controllers;

use App\Reports\TournamentReport;

class DashboardController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('layouts.backend');
    }
}