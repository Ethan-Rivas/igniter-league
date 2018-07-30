@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card tournaments-container">

            <!-- View ONLY for admins -->
            <div class="tournaments-admin">
              <h3>Create Tournament</h3>

              <form method="POST" action="{{ route('tournaments.new') }}" aria-label="{{ __('Create Tournament') }}">
                  @csrf

                  <div class="form-group">
                      <label for="tournament-name" class="col-form-label text-md-right">{{ __('Tournament Name') }}</label>

                      <div class="">
                          <input id="tournament-name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                          @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="description" class="col-form-label text-md-right">{{ __('Description') }}</label>

                      <div class="">
                          <textarea id="tournament-description"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" rows="8" cols="80" required></textarea>

                          @if ($errors->has('description'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('description') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Tournament') }}
                    </button>
                  </div>
              </form>
            </div>

          </div>
      </div>
  </div>
</div>
@endsection
