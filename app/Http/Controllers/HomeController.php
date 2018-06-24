<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use RiotAPI\RiotAPI;
use RiotAPI\Definitions\Region;

use DataDragonAPI\DataDragonAPI;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        //  Initialize the library
        $api = new RiotAPI([
          //  Your API key, you can get one at https://developer.riotgames.com/
          RiotAPI::SET_KEY    => env('LEAGUE_API_KEY', ''),
          //  Target region (you can change it during lifetime of the library instance)
          RiotAPI::SET_REGION => Region::LAMERICA_NORTH,
        ]);

        $summoner = $api->getSummonerByName($current_user->summoner_name);

        $summoner_data = array('summoner_id'     => $summoner->id,
                               'summoner_name'   => $summoner->name,
                               'summoner_icon'   => 'http://ddragon.leagueoflegends.com/cdn/6.5.1/img/profileicon/'.$summoner->profileIconId.'.png',
                               'summoner_league' => $api->getLeaguePositionsForSummoner($summoner->id));

        $summoner_data = (object) $summoner_data;

        return view('home')->with('data', $summoner_data);
    }
}
