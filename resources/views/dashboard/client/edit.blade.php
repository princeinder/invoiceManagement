@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $client->name }}</div>
                    <div class="card-body">
                        <form method="POST" action="/client/{{ $client->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $client->name }}" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Email') }}" name="email" value="{{ $client->email }}" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Address</label>
                                <textarea class="form-control" id="textarea-input" name="address" rows="9"  value="{{ $client->address }}" placeholder="{{ __('Address') }}" required>{{ $client->address }}</textarea>
                            </div>
                            <div class="form-group row">
                                <label>Bill To Address</label>
                                <textarea class="form-control" id="textarea-input" name="billing_address" rows="9" value="{{ $client->billing_address }}" placeholder="{{ __('Bill To Address') }}" required>{{ $client->billing_address }}</textarea>
                            </div>
                            <div class="form-group row">
                                <label>Bank Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Bank Name') }}" name="bank_name"   value="{{ $client->bank_name }}" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Bank Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Account Number') }}" name="account_number"  value="{{ $client->account_number }}" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Bank Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Swif Code') }}" name="swif_code"  value="{{ $client->swif_code }}" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Transit Number</label>
                                <input class="form-control" type="text" placeholder="{{ __('Transit Number') }}" name="transit_number"  value="{{ $client->transit_number }}" required autofocus>
                            </div>
                            <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="{{ route('client.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a> 
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection