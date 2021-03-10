@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Projects') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('project.create') }}" class="btn btn-primary m-2">{{ __('Add Project') }}</a>
                          <a href="{{ route('project.create') }}" class="btn btn-primary m-2">{{ __('Generate Invoice') }}</a>
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
                          <th>#</th>
                            <th>Sr no.</th>
                            <th>PO Number</th>
                            <th>Project Name</th>
                            <th>Client Name</th>
                            <th>Complete</th>
                            <th>CPI</th>
                            <th>Total</th>
                            <th>Due Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($projects as $p=>$project)
                            <tr>
                            <td><input type="checkbox" class="form-control"/></td>
                              <td><strong>{{$p+1}}</strong></td>
                              <td>{{ $project->po_number }}</td>
                              <td><strong>{{ $project->project_name }}</strong></td>
                              <td>{{ $project->financial_contact_name }}</td>
                              <td>{{ $project->complete }}</td>
                              <td>{{ $project->cpi }}</td>
                              <td>{{ $project->complete*$project->cpi  }}</td>
                              <td>{{ $project->due_date }}</td>
                              </td>
                              <td>
                                <a href="{{ url('/client/' . $project->id . '/edit') }}" class="btn  btn-primary"><i class="bi bi-pencil-fill"></i></a>

                                <form class="delete-action" style= action="{{ route('project.destroy', $project->id ) }}" method="POST">
            
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn  btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $projects->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection

