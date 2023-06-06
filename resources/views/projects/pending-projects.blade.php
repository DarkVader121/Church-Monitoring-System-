@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Pending Projects') }}</b></div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
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
                                <td style="color:#fbd500;"><b>{{ $project->status }}</b></td>
                              
                               
                                @if (auth()->user()->isParish())
                                <td>
                                    <!-- <form method="POST" action="/projects/{{ $project->id }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form> -->
                                    <a href="/projects/{{ $project->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                   
                                    
                                    &nbsp;
                                    &nbsp;
                                    <form method="POST" action="/projects/{{ $project->id }}/approved" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-success btn-sm"onclick="sweetAlertConfirmation({{ $project->id }})" >Approve</button>
                                    </form> 

                                  
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        @include ('projects.modal.cancelled-project')
                                </td>
                                @endif

                                @if (auth()->user()->isAdmin())
                                <td> 
                                <a href="/projects/{{ $project->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                 <a href="/projects/{{ $project->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                &nbsp;
                                &nbsp;
                                    <form method="POST" action="/projects/{{ $project->id }}/approved" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-success btn-sm" onclick="sweetAlertConfirmation({{ $project->id }})">Approve</button>
                                    </form> 
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal">
                                            Reject
                                        </button>
                                        @include ('projects.modal.cancelled-project')
                                     
                                </td>
                                @endif

                                @if(auth()->user()->isPpc() || auth()->user()->isPfc() || auth()->user()->isCommissionHead() || auth()->user()->isPfcAdmin() )
                                <td> 
                                  <a href="/projects/{{ $project->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                @endif
                                </td>
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


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<script>
  function sweetAlertConfirmation(id) {
    swal({
      title: "Are you sure you want to approve this project?",
      text: "Upon approval, the project will be transferred to the approved section.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/projects/' + id + '/approved"]').submit();
      }
    });
  }
</script>
@endpush



