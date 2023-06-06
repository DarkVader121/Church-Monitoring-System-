@extends('layouts.app')

@section('content')
<div class="container">

@if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
@endif

@if (auth()->user()->isAdmin() || auth()->user()->isPpc() ) 
<div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-plus"></i> <b>ADD PROJECT</b> 
    </button>
    </div>
    @endif
    @include ('projects.modal.create')
    <br>


  

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Project lists') }}</b></div>
          
                <div class="card-body">
              
    
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Project ID</th>
                                <th>Project Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Budget</th>
                                <th>Project Status</th>
                               
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->date->toFormattedDateString() }}</td>
                                  <td>{{ date('M j, Y', strtotime($project->projectTargetDeadline )) }}</td>
                                <td>₱ {{ number_format($project->budget, 0, '.', ',' ) }}</td>
                                    @if ($project->status == 'Approved')
                                    <td style="color:green; "><b>{{ $project->status }}</b></td>
                                    @elseif ($project->status == 'Cancelled')
                                    <td style="color:red;"><b>{{ $project->status }}</b></td>
                                    @elseif ($project->status == 'Pending')
                                    <td style="color:#FFD700;"><b>{{ $project->status }}</b></td>
                                    @elseif ($project->status == 'Archived')
                                    <td style="color:#f9bf00;"><b>{{ $project->status }}</b></td>
                                    @endif
                             
                                      <td class="align-self-center text-center">  <a href="/projects/{{ $project->id }}/show" class="btn btn-primary btn-sm">Show</a>  </td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push ('scripts')

  <script type="text/javascript">
   $(document).ready( function () {
       $('#myTable').DataTable();
   });
</script>  
@endpush
