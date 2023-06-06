@extends('layouts.app')

@section('content')

    <div class="container ml-10">

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header" style="background-color: #f9bf00;  color:white;"><b>{{ __('Archived Events') }}</b></div>

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
                            <td style="color:#f9bf00;"><b>{{ $event->status }}</b></td>
                           
                                <td class="align-self-center text-center"> <a href="/events/{{ $event->id }}/show" class="btn btn-primary btn-sm">Show</a>
                              
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
@endsection


