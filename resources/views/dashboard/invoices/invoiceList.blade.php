@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Invoices') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('invoice.create') }}" class="btn btn-primary m-2">{{ __('Add Invoice') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Applies to date</th>
                            <th>Status</th>
                            <th>Note type</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($clients as $client)
                            <tr>
                              <td><strong>{{ $client->user->name }}</strong></td>
                              <td><strong>{{ $client->title }}</strong></td>
                              <td>{{ $client->content }}</td>
                              <td>{{ $client->applies_to_date }}</td>
                              <td>
                                  <span class="{{ $note->status->class }}">
                                      {{ $client->status->name }}
                                  </span>
                              </td>
                              <td><strong>{{ $client->note_type }}</strong></td>
                              <td>
                                <a href="{{ url('/clients/' . $client->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/clients/' . $client->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('client.destroy', $client->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
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

