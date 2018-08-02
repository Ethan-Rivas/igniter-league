<?php

namespace App\Http\Controllers;

use App\Provider as Provider;
use Illuminate\Http\Request;

// Riot API
use RiotAPI\RiotAPI;
use RiotAPI\Definitions\Region;

// Carbon to get timestamp
use Carbon\Carbon;

class ProviderController extends Controller
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
        // Get all Providers from Database.
        $providers = Provider::all();

        // Load providers view with providers
        return view('providers')->with('providers', $providers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provider = new Provider;
        $provider->provider_id =  1;//$request->provider_id;
        $provider->provider_url = $request->provider_url;
        $provider->save();

        return redirect()->route('providers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return Provider::findOrFail($provider->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $provider = new Provider;
        $provider->provider_id = $request->provider_id;
        $provider->provider_url = $request->provider_url;
        $tournament->save();

        return redirect()->route('providers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        // Date time now to timestamp
        $current_time = Carbon::now()->toDayDateTimeString(); // Mon, Jun 30, 2018 00:00 PM
        $current_timestamp = Carbon::now()->timestamp;

        // Insert timestamp for softdelete
        $provider = new Provider;
        $provider->deleted_at = $current_timestamp;
        $provider->save();
    }
}
