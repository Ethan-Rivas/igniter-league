@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card tournaments-container">

            <div class="row header-container">
              <div class="col-md-6">
                <h3>Tournaments</h3>

              </div>

              <!-- Create tournaments button (uncomment when provider has been already setup)
              <div class="col-md-6">
                <a href="/tournaments/new">
                  <button type="button" class="btn btn-primary float-right" name="button">Create Tournament</button>
                </a>
              </div> -->
            </div>

            <!-- This will be the view for all the tournaments (guest, users and admins)-->
            <div class="tournaments list">
              <!-- If there are tournaments in database -->
              @if (count($tournaments) > 0)
                <!-- Show all tournaments available -->
                @foreach ($tournaments as $tournament)
                  <div class="tournament">
                    <!-- Verify if tournament has code and a real provider -->
                    @if ($tournament->tournament_code and $tournament->provider_id)
                      <div class="float-right">
                        Valid and Registered Tournament! (<i>Register your team <a href="#">here </a></i>)
                      </div>
                    @else
                      <div class="float-right">Unregistered Tournament! (<i>contact an <a href="#">admin </a></i>)</div>
                    @endif

                    <!-- Show Tournament information -->
                    <div class="">
                      <strong>Tournament:</strong> {{$tournament->name}} <br>
                      <strong>Description:</strong> {{$tournament->description}} <br>
                    </div>
                  </div>
                @endforeach
                <!-- If there are not tournaments in database -->
              @else
                <p><i>No tournaments available, come back later or if you're a provider, go <a href="#">create one!</a></i></p>
              @endif
            </div>

          </div>
      </div>
  </div>
</div>
@endsection
