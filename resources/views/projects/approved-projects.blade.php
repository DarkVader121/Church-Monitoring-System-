@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Approved Projects') }}</b></div>
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
                                <td style="color:green;"><b>{{ $project->status }}</b></td>
                              
                                <td class="align-self-center text-center"> <a href="/projects/{{ $project->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                @if (auth()->user()->isAdmin())
                                
                                <form method="POST" action="/projects/{{ $project->id }}/archived" style="display: inline-block;">
                                       @csrf
                                       {{ method_field('PATCH') }}
                                       <button type="button" class="btn btn-outline-warning  btn-sm" onclick="sweetAlertConfirmation({{ $project->id }})">Archive</button>
                               </form> 
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

@push ('scripts') 
  <script type="text/javascript">
   $(document).ready( function () {
       $('#myTable').DataTable();
   });
</script>  
@endpush

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<script>
  function sweetAlertConfirmation(id) {
    swal({
      title: "Are you sure you want to archive this project?",
      text: "Once archived, the project cannot be unarchived.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/projects/' + id + '/archived"]').submit();
      }
    });
  }
</script>
@endsection

