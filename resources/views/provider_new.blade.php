@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card tournaments-container">

            <!-- View ONLY for admins -->
            <div class="providers-admin">
              <h3>Create Provider</h3>

              <form method="POST" action="{{ route('providers.new') }}" aria-label="{{ __('Add new Provider') }}">
                  @csrf

                  <div class="form-group">
                      <label for="provider-url" class="col-form-label text-md-right">{{ __('Provider Url') }}</label>

                      <div class="">
                          <input id="provider-url" type="text" class="form-control{{ $errors->has('provider_url') ? ' is-invalid' : '' }}" name="provider_url" value="{{ old('provider_url') }}" required autofocus>

                          @if ($errors->has('provider_url'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('provider_url') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Provider') }}
                    </button>
                  </div>
              </form>
            </div>

          </div>
      </div>
  </div>
</div>
@endsection
