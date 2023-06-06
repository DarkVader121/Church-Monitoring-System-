@extends('layouts.app')

@section('content')
<div class="container">
    @if (auth()->user()->isAdmin() || auth()->user()->isPpc() || auth()->user()->isCommissionHead())
    <div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-plus"></i> <b>ADD EVENT</b> 
    </button>
    </div>
    @endif
@include ('events.modal.create')
    <br>
    <div class="container">

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Event Lists') }}</b></div>
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
                            <th>Venue</th>
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
                                @if ($event->status == 'Approved')
                                    <td style="color:green; "><b>{{ $event->status }}</b></td>
                                @elseif ($event->status == 'Cancelled')
                                    <td style="color:red;"><b>{{ $event->status }}</b></td>
                                @elseif ($event->status == 'Pending')
                                    <td style="color:#ed8200;"><b>{{ $event->status }}</b></td>
                                    @elseif ($event->status == 'Archived')
                                    <td style="color:#f9bf00;"><b>{{ $event->status }}</b></td>
                                @endif
                                <td>{{ $event->venue}}</td>
                                <td class="align-self-center text-center">
                                    <a href="/events/{{ $event->id }}/show" class="btn btn-primary btn-sm">Show</a>
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
@endpush

