@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Clients') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('client.create') }}" class="btn btn-primary m-2">{{ __('Add Client') }}</a>
                          @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Sr no.</th>
                            <th>Company Name</th>
                            <th>Financial Contact Name</th>
                            <th>Financial Email</th>
                            <th>Address</th>
                            <th>Bill To Address</th>
                            <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>Swif Code</th>
                            <th>Transit Number</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($clients as $c=>$client)
                            <tr>
                              <td><strong>{{$c+1}}</strong></td>
                              <td><strong>{{ $client->company_name }}</strong></td>
                              <td>{{ $client->financial_contact_name }}</td>
                              <td>{{ $client->email }}</td>
                              <td>{{ $client->address }}</td>
                              <td>{{ $client->billing_address }}</td>
                              <td>{{ $client->bank_name }}</td>
                              <td>{{ $client->account_number}}</td>
                              <td>{{ $client->swif_code}}</td>
                              <td>{{ $client->transit_number}}</td>
                              </td>
                              <td>
                                <!-- <a href="{{ url('/client/' . $client->id) }}" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a> -->
                                <a href="{{ url('/client/' . $client->id . '/edit') }}" class="btn  btn-primary"><i class="bi bi-pencil-fill"></i></a>

                                <form class="delete-action" style= action="{{ route('client.destroy', $client->id ) }}" method="POST">
            
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn  btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $clients->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection

