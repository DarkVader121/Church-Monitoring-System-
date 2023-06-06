@extends('layouts.app')

@section('content')
<div class="container">
   

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Approved Meeting List') }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project</th>
                                <th>Meeting Name</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Status</th>
                                
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $meeting)
                            <tr>
                                <td>{{ $meeting->id }}</td>
                                <td>{{ $meeting->project ? $meeting->project->project_name : 'No project' }}</td>
                                <td>{{ $meeting->meeting_name }}</td>
                                <td>{{ $meeting->venue }}</td>
                                <td>{{ date('M j, Y', strtotime($meeting->date_time)) }}</td>
                                <td style="color:green;"><b>{{ $meeting->status }}</b></td>
                                @if (auth()->user()->isAdmin())
                                <td class="align-self-center text-center">
                                    <a href="/meetings/{{ $meeting->id }}/show" class="btn btn-primary btn-sm">Show</a>

                                    
                                    <!-- <a href="/meetings/{{ $meeting->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a> -->
                                    &nbsp;
                                    &nbsp;

                                    <form method="POST" action="/meetings/{{ $meeting->id }}/archive" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="sweetAlertConfirmation({{ $meeting->id }})">Archive</button>
                                    </form> 

                                 
                                    <!-- <form method="POST" action="/meetings/{{ $meeting->id }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form> -->

                                </td>
                                @endif

                                @if (auth()->user()->isPpc() || auth()->user()->isCommissionHead() || auth()->user()->isPpc())
                                <td class="align-self-center text-center">

                                    
                                    <a href="/meetings/{{ $meeting->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                    <!-- <a href="/meetings/{{ $meeting->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a> -->
                                </td>
                                @endif

                                @if (auth()->user()->isParish() ||  auth()->user()->isPfc() || auth()->user()->isPfcAdmin())
                                <td class="align-self-center text-center">

                                    
                                    <a href="/meetings/{{ $meeting->id }}/show" class="btn btn-primary btn-sm">Show</a>
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
      title: "Are you sure you want to archive this meeting?",
      text: "Once archived, the donation cannot be unarchived.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/meetings/' + id + '/archive"]').submit();
      }
    });
  }
</script>

@endpush
