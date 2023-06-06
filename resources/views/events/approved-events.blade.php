@extends('layouts.app')

@section('content')

    <div class="container ml-10">

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">  
        <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Approved Events') }}</b></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>Linked Project</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Event Status</th>
                                <th>Action</th>                 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->event_name }}</td> 
                            <td>{{ $event->project ? $event->project->project_name : '' }}</td>
                            <td>{{ $event->date->toFormattedDateString() }}</td>
                            <td>{{ date('M j, Y', strtotime( $event->eventsTargetDeadline)) }}</td>
                            <td style="color:green;"><b>{{ $event->status }}</b></td>
                           
                                <td class="align-self-center text-center"> <a href="/events/{{ $event->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                @if (auth()->user()->isAdmin())
                                
                                <form method="POST" action="/events/{{ $event->id }}/archived" style="display: inline-block;">
                                       @csrf
                                       {{ method_field('PATCH') }}
                                       <button type="button" class="btn btn-outline-warning  btn-sm" onclick="sweetAlertConfirmation({{ $event->id }})">Archive</button>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<script>
  function sweetAlertConfirmation(id) {
    swal({
      title: "Are you sure you want to archive this event?",
      text: "Once archived, the event cannot be unarchived.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/events/' + id + '/archived"]').submit();
      }
    });
  }
</script>
@endpush
@endsection


