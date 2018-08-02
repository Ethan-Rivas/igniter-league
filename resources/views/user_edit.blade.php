@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <div class="card-header">{{ __('Edit User: '.$user->first_name.' '.$user->last_name) }}</div>
        <!-- View ONLY for admins -->
        <div class="card-body">
          <form method="POST" action="{{ route('users.edit', $user->id) }}" aria-label="{{ __('Edit User') }}">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $user->first_name }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $user->last_name }}" required autofocus>

                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="summoner_name" class="col-md-4 col-form-label text-md-right">{{ __('Summoner Name') }}</label>

                <div class="col-md-6">
                    <input id="summoner_name" type="text" class="form-control{{ $errors->has('summoner_name') ? ' is-invalid' : '' }}" name="summoner_name" value="{{ $user->summoner_name }}" required autofocus>

                    @if ($errors->has('summoner_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('summoner_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
              <label for="provider" class="col-md-4 col-form-label text-md-right">{{ __('Tournament Provider') }}</label>

              <div class="col-md-6">
                <select class="form-control" name="provider_id">
                  @if ($providers->count())
                    @foreach($providers as $provider)
                      <option value="" {{ $user->provider_id == $provider->id ? '' : 'selected="selected"' }} disabled>Select a Provider</option>
                      <option value="{{ $provider->id }}" {{ $user->provider_id == $provider->id ? 'selected="selected"' : '' }}>{{ $provider->provider_url }}</option>
                    @endforeach
                  @endif
                </select>

                <div class="message-field">
                  <i>A provider allow users to create tournaments</i>
                </div>
              </div>

            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4 ">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
