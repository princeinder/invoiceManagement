@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Create Project') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('project.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Project Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Project Name') }}" name="project_name" required autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Client Name</label>
                                <select  class="form-control"  name="client_id">
                                <option value="">
                                Select Client
                                </option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}">
                                {{ $client->financial_contact_name }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label>Terms Net</label>
                                <input class="form-control" type="text"  name="terms_net" placeholder="{{ __('Terms Net') }}" required/>
                            </div>
                            <div class="form-group row">
                                <label>Due Date</label>
                                <input class="form-control" type="date"  name="due_date" placeholder="{{ __('Due Date') }}" required autofocus/>
                            </div>
                            <div class="form-group row">
                                <label>Complete</label>
                                <input class="form-control"  type="number" name="complete"  placeholder="{{ __('Complete') }}" required autofocus/>
                            </div>
                            <div class="form-group row">
                                <label>CPI</label>
                                <input class="form-control" type="number"  name="cpi" placeholder="{{ __('Cpi') }}" required autofocus/>
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
                            <a href="{{ route('project.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a> 
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