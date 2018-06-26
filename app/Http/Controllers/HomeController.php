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

        $summoner_data = $this->getSummoner($api, $current_user->summoner_name);
        $session_matches = session()->get('matches');

        return view('home')->with('data', $summoner_data)
                           ->with('api', $api)
                           ->with('session_matches', $session_matches);
    }

    /**
     * Gets Summoner information based on current user summoner_name
     *
     * @param object $api
     * @param string $summoner_name
     */
    public static function getSummoner($api, $summoner_name) {
      $summoner = $api->getSummonerByName($summoner_name);

      $summoner_data = array('summoner_id'     => $summoner->accountId,
                             'summoner_name'   => $summoner->name,
                             'summoner_icon'   => 'http://ddragon.leagueoflegends.com/cdn/6.5.1/img/profileicon/'.$summoner->profileIconId.'.png',
                             'summoner_league' => $api->getLeaguePositionsForSummoner($summoner->id));

      $summoner_data = (object) $summoner_data;

      return $summoner_data;
    }

    /**
     * Creates an Array of last 10 Matches
     *
     * @param object $api
     * @param string $accountId
     */
    public function getMatches($api, $accountId) {
      // Set array of matchIds to get matches information
      $matchList = $api->getMatchlistByAccount($accountId);
      $matchIds = [];

      $i = 0;
      foreach ($matchList as $match) {
        $matchIds[] = $match->gameId;

        // Limit to 10 matches
        if(++$i >= 10) break;
      }

      // Save matches information on `matches` array
      $matches = [];
      foreach ($matchIds as $id) {
        $matches[] = $api->getMatch($id);
      }

      // Convert Array to Object
      $matches = (object) $matches;

      return $matches;
    }
}
