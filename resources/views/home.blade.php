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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
