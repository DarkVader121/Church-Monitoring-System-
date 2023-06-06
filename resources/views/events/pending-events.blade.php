@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Pending Events') }}</b></div>

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
                            <th>Event Status</th>
                    
                            <th>Action</th>
                               
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ Str::limit($event->event_name, 20) }}</td> 
                            <td>{{ $event->project ? Str::limit($event->project->project_name, 20) : '' }}</td>

                            <td>{{ $event->date->toFormattedDateString() }}</td>
                            <td style="color:#FFD700;"><b>{{ $event->status }}</b></td>
                           
                        
                                 @if (auth()->user()->isAdmin())
                                 <td> 
                                      <a href="/events/{{ $event->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                      <a href="/events/{{ $event->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                      &nbsp;
                                     
                                <form method="POST" action="/events/{{ $event->id }}/approved" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-success btn-sm" onclick="sweetAlertConfirmation({{ $event->id }})">Approve</button>
                                    </form>  

                                    <!-- <form method="POST" action="/events/{{ $event->id }}/cancelled" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form> -->

                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        @include ('events.modal.cancelled-event')
                                
                                        
                                   
                                </td>
                                @endif

                                @if (auth()->user()->isParish())
                                 <td> 
                                 <a href="/events/{{ $event->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                 &nbsp;
                                 &nbsp;
                                    <form method="POST" action="/events/{{ $event->id }}/approved" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-success btn-sm" onclick="sweetAlertConfirmation({{ $event->id }})">Approved</button>
                                    </form>  

                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                
                                    @include ('events.modal.cancelled-event')

                                </td>
                                @endif
                                @if (auth()->user()->isCommissionHead() || auth()->user()->isPpc() || auth()->user()->isPfc() || auth()->user()->isPfcAdmin())
                                 <td> 
                                 <a href="/events/{{ $event->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                </td>
                                @endif
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
      title: "Are you sure you want to approve this event?",
      text: "Upon approval, the event will be transferred to the approved section.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/events/' + id + '/approved"]').submit();
      }
    });
  }
</script>
@endpush
