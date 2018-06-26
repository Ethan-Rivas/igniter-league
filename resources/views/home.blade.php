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
                            use DataDragonAPI\DataDragonAPI;

                            $a = new HomeController;

                            DataDragonAPI::initByCdn();

                            if (isset($_GET['matches'])) {

                              if(!empty($session_matches) and isset($_GET['reload'])) {
                                $session_matches = session()->put('matches', $a->getMatches($api, $data->summoner_id));
                                $matches = $session_matches;
                              } elseif(!empty($session_matches)) {
                                $matches = $session_matches;
                              } else {
                                $session_matches = session()->put('matches', $a->getMatches($api, $data->summoner_id));
                                $matches = $session_matches;
                              }

                              if (is_array($matches) || is_object($matches)) {
                                foreach ($matches as $match) {

                                  $participantId = 0;
                                  $participantStats = [];
                                  $championId = 0;

                                  foreach($match->participantIdentities as $identity) {
                                    if($identity->player->summonerName == $data->summoner_name) {
                                      $participantId = $identity->participantId;
                                    }
                                  }

                                  foreach($match->participants as $participant) {
                                    if($participantId == $participant->participantId) {
                                      $participantStats = $participant->stats;
                                      $championId = $participant->championId;
                                    }
                                  }

                                  $champion_name = $api->getChampionById($championId)->name;
                                  $championUrl = preg_replace('/\s/', '', DataDragonAPI::getChampionIconUrl($champion_name));
                                  $kda = number_format((($participantStats->kills+$participantStats->assists)/$participantStats->deaths), 2);

                                  $items = array(0 => DataDragonAPI::getItemIcon($participantStats->item0),
                                                 1 => DataDragonAPI::getItemIcon($participantStats->item1),
                                                 2 => DataDragonAPI::getItemIcon($participantStats->item2),
                                                 3 => DataDragonAPI::getItemIcon($participantStats->item3),
                                                 4 => DataDragonAPI::getItemIcon($participantStats->item4),
                                                 5 => DataDragonAPI::getItemIcon($participantStats->item5),
                                                 6 => DataDragonAPI::getItemIcon($participantStats->item6));

                                  // Show formatted list of matches
                                  if($match->teams[0]->win == "Win") {
                                    echo "<div class='win-container'>
                                            <div class='row'>
                                              <!-- Champion Image -->
                                              <div class='col-md-2'>
                                                <div>
                                                  <img style='width: 100%;' src='$championUrl' alt='$champion_name' />
                                                </div>
                                              </div>

                                              <!-- Game Information -->
                                              <div class='col-md-2'>
                                                <div>
                                                  <span style='font-weight: bold; color: #7FC787'>VICTORY</span><br>
                                                  <span class='game-mode'>$match->gameMode</span>
                                                </div>
                                              </div>

                                              <!-- Summoner Performance -->
                                              <div class='col-md-8'>
                                                <div>
                                                  $participantStats->kills/$participantStats->deaths/$participantStats->assists <br />
                                                  <span style='font-weight: bold;'>$kda</span> KDA
                                                </div>

                                                <div>
                                                  $items[0]
                                                  $items[1]
                                                  $items[2]
                                                  $items[3]
                                                  $items[4]
                                                  $items[5]
                                                  $items[6]
                                                </div>
                                              </div>
                                            </div>
                                          </div>";
                                  } else {
                                    echo "<div class='lose-container'>
                                            <div class='row'>
                                              <!-- Champion Image -->
                                              <div class='col-md-2'>
                                                <div>
                                                  <img style='width: 100%;' src='$championUrl' alt='$champion_name' />
                                                </div>
                                              </div>

                                              <!-- Game Information -->
                                              <div class='col-md-2'>
                                                <div>
                                                  <span style='font-weight: bold; color: #FF7F7F;'>DEFEAT</span><br>
                                                  <span class='game-mode'>$match->gameMode</span>
                                                </div>
                                              </div>

                                              <!-- Summoner Performance -->
                                              <div class='col-md-8'>
                                                $participantStats->kills/$participantStats->deaths/$participantStats->assists <br />
                                                <span style='font-weight: bold;'>$kda</span> KDA
                                              </div>

                                              <div>
                                                $items[0]
                                                $items[1]
                                                $items[2]
                                                $items[3]
                                                $items[4]
                                                $items[5]
                                                $items[6]
                                              </div>
                                            </div>
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
