<?php

namespace App\Http\Controllers;

use App\User as User;
use Illuminate\Http\Request;

// Carbon to get timestamp
use Carbon\Carbon;

// Load Providers
use App\Provider as Provider;

class UserController extends Controller
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
        // Get all Users from Database.
        $users = User::all();

        // Load providers view with providers
        return view('users')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->first_name =  $request->first_name;
        $user->last_name = $request->last_name;
        $user->summoner_name = $request->summoner_name;
        $user->email = $request->email;
        $user->provider_id = $request->provider_id;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return User::findOrFail($user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = new User;
        $providers = new Provider;

        return view('user_edit')->with('user', $user::findOrFail($id))
                                ->with('providers', $providers::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = $user::find($request->id);
        $user->first_name =  $request->first_name;
        $user->last_name = $request->last_name;
        $user->summoner_name = $request->summoner_name;
        $user->email = $request->email;
        $user->provider_id = $request->provider_id;
        //$user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Date time now to timestamp
        $current_time = Carbon::now()->toDayDateTimeString(); // Mon, Jun 30, 2018 00:00 PM
        $current_timestamp = Carbon::now()->timestamp;

        // Insert timestamp for softdelete
        $user = new User;
        $user->deleted_at = $current_timestamp;
        $user->save();
    }
}
