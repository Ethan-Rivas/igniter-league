@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="leagues row">
                      <div class="col-md-6">
                        <div class="league-card">
                          {{str_replace('_', ' ',$data->summoner_league[0]->queueType)}}<br>

                          <!-- LEAGUE TIER IMAGE -->
                          <div class="" style="margin: 0 auto;">
                            @if ($data->summoner_league[0]->tier == "BRONZE")
                              <img src="/images/tier-icons/base-icons/bronze.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[0]->tier == "SILVER")
                              <img src="/images/tier-icons/base-icons/silver.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[0]->tier == "GOLD")
                              <img src="/images/tier-icons/base-icons/gold.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[0]->tier == "PLATINUM")
                              <img src="/images/tier-icons/base-icons/platinum.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[0]->tier == "DIAMOND")
                              <img src="/images/tier-icons/base-icons/diamond.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[0]->tier == "MASTER")
                              <img src="/images/tier-icons/base-icons/master.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[0]->tier == "CHALLENGER")
                              <img src="/images/tier-icons/base-icons/challenger.png" alt="" width="150px" height="150px">
                            @else
                              <img src="/images/tier-icons/base-icons/provisional.png" alt="" width="150px" height="150px">
                            @endif
                          </div>

                          {{$data->summoner_league[0]->tier}} {{$data->summoner_league[0]->rank}}<br>
                          {{$data->summoner_league[0]->leagueName}}<br>

                          Wins: {{$data->summoner_league[0]->wins}} - Losses: {{$data->summoner_league[0]->losses}}<br>
                          Points: {{$data->summoner_league[0]->leaguePoints}}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="league-card">
                          {{str_replace('_', ' ',$data->summoner_league[1]->queueType)}}<br>

                          <!-- LEAGUE TIER IMAGE -->
                          <div class="" style="margin: 0 auto;">
                            @if ($data->summoner_league[1]->tier == "BRONZE")
                              <img src="/images/tier-icons/base-icons/bronze.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[1]->tier == "SILVER")
                              <img src="/images/tier-icons/base-icons/silver.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[1]->tier == "GOLD")
                              <img src="/images/tier-icons/base-icons/gold.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[1]->tier == "PLATINUM")
                              <img src="/images/tier-icons/base-icons/platinum.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[1]->tier == "DIAMOND")
                              <img src="/images/tier-icons/base-icons/diamond.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[1]->tier == "MASTER")
                              <img src="/images/tier-icons/base-icons/master.png" alt="" width="150px" height="150px">
                            @elseif ($data->summoner_league[1]->tier == "CHALLENGER")
                              <img src="/images/tier-icons/base-icons/challenger.png" alt="" width="150px" height="150px">
                            @else
                              <img src="/images/tier-icons/base-icons/provisional.png" alt="" width="150px" height="150px">
                            @endif
                          </div>

                          {{$data->summoner_league[1]->tier}} {{$data->summoner_league[1]->rank}}<br>
                          {{$data->summoner_league[1]->leagueName}}<br>

                          Wins: {{$data->summoner_league[1]->wins}} - Losses: {{$data->summoner_league[1]->losses}}<br>
                          Points: {{$data->summoner_league[1]->leaguePoints}}
                        </div>
                      </div>

                    </div>

                    <div class="tabs-area">
                      <ul class="nav nav-tabs">
                          <li><a data-toggle="tab" href="#activity">Activity</a></li>
                          <li class="active"><a data-toggle="tab" href="#history">Matches</a></li>
                          <li><a data-toggle="tab" href="#tournaments">Igniter</a></li>
                      </ul>
                    </div>


                    <div class="tab-content">
                        <div id="activity" class="tab-pane fade">
                            <p>Activity</p>
                        </div>
                        <div id="history" class="tab-pane fade in active show">
                          <!-- Generated History of Matches -->
                          @if (!$session_matches)
                            <a class="btn btn-primary" href="?matches=true">Load Recent Matches</a>
                          @else
                            <a class="btn btn-primary" href="?matches=true&reload=true">Reload Matches</a>
                          @endif

                          <?php
                            use App\Http\Controllers\HomeController;
                            $a = new HomeController;

                            if (isset($_GET['matches'])) {

                              if(!empty($session_matches) and isset($_GET['reload'])) {
                                $session_matches = session()->put('matches', $a->getMatches($api, $data->summoner_id));
                                $matches = $session_matches;
                                $loaded_matches = 1;
                              } elseif(!empty($session_matches)) {
                                $matches = $session_matches;
                                $loaded_matches = 1;
                              } else {
                                $session_matches = session()->put('matches', $a->getMatches($api, $data->summoner_id));
                                $matches = $session_matches;
                                $loaded_matches = 1;
                              }

                              if (is_array($matches) || is_object($matches)) {
                                foreach ($matches as $match) {
                                  if($match->teams[0]->win == "Win") {
                                    echo "<div class='win-container'>
                                            <span>VICTORY</span><br>
                                            <span class='game-mode'>$match->gameMode</span>
                                          </div>";
                                  } else {
                                    echo "<div class='lose-container'>
                                            <span>DEFEAT</span><br>
                                            <span class='game-mode'>$match->gameMode</span>
                                          </div>";
                                  }
                                }
                              }
                            }
                          ?>

                        </div>
                        <div id="tournaments" class="tab-pane fade">
                            <p>Igniter Leagues (Coming Soon)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
