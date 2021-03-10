@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Create Client') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('client.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Company Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="company_name" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Financial Contact Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Financial Contact Name') }}" name="financial_contact_name" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Financial Email</label>
                                <input class="form-control" type="email" id="textarea-input" name="email" placeholder="{{ __('Financial Email') }}" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label>Financial Address</label>
                                <input class="form-control" type="text" id="textarea-input" name="address" placeholder="{{ __('Financial Address') }}" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label>Bill To Address</label>
                                <textarea class="form-control" id="textarea-input" name="billing_address" rows="9" placeholder="{{ __('Bill To Address') }}" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label>Bank Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Bank Name') }}" name="bank_name" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Account Number</label>
                                <input class="form-control" type="text" placeholder="{{ __('Account Number') }}" name="account_number" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Swif Code</label>
                                <input class="form-control" type="text" placeholder="{{ __('Swif Code') }}" name="swif_code" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Transit Number</label>
                                <input class="form-control" type="text" placeholder="{{ __('Transit Number') }}" name="transit_number" required autofocus>
                            </div>

                                           @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                            <button class="btn btn-block btn-success" type="submit">{{ __('Add') }}</button>
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