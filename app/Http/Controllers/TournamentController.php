<?php

namespace App\Http\Controllers;

use App\Tournament as Tournament;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

// Riot API
use RiotAPI\RiotAPI;
use RiotAPI\Definitions\Region;

// DDragon API
use DataDragonAPI\DataDragonAPI;

// Carbon to get timestamp
use Carbon\Carbon;

class TournamentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all Tournaments from Database.
        $tournaments = Tournament::all();

        // Load tournament view with tournaments
        return view('tournaments')->with('tournaments', $tournaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('tournament_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tournament = new Tournament;
        $tournament->name = $request->name;
        $tournament->description = $request->description;
        $tournament->provider_id = $request->provider;
        $tournament->save();

        return redirect()->route('tournaments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        return Tournament::findOrFail($tournament->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
      return view('tournaments_edit')->with('tournaments', $tournaments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        $tournament = new Tournament;
        $tournament->name = $request->name;
        $tournament->description = $request->description;
        $tournament->provider_id = $request->provider;
        $tournament->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        // Date time now to timestamp
        $current_time = Carbon::now()->toDayDateTimeString(); // Mon, Jun 30, 2018 00:00 PM
        $current_timestamp = Carbon::now()->timestamp;

        // Insert timestamp for softdelete
        $tournament = new Tournament;
        $tournament->deleted_at = $current_timestamp;
        $tournament->save();
    }
}
