@extends('layouts.app')

@section('content')
<div class="container">

     
                  
   @if (auth()->user()->isAdmin() || auth()->user()->isCommissionHead() || auth()->user()->isPpc())
   <div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
   <i class="fa fa-plus"></i> <b>ADD MEETING</b> 
    </button>
    </div>
    @endif

    @include ('meetings.modal.create')

   

    <div class="mt-3 row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Meeting List') }}</b></div>

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
                                <!-- <th>Project</th> -->
                                <!-- <th>Meeting Sponsor</th> -->
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
                                <!-- <td>{{ $meeting->project ? $meeting->project->project_name : ' ' }}</td> -->
                                <!-- <td>{{ $meeting->meeting_sponsor}}</td> -->
                                <td>{{ $meeting->meeting_name }}</td>
                                <td>{{ $meeting->venue }}</td>
                                <td>{{ date('M j, Y', strtotime($meeting->date_time)) }}</td>
                                @if ($meeting->status == 'Approved')
                                    <td style="color:green; "><b>{{ $meeting->status }}</b></td>
                                @elseif ($meeting->status == 'Cancelled')
                                    <td style="color:red;"><b>{{ $meeting->status }}</b></td>
                                @elseif ($meeting->status == 'Pending')
                                    <td style="color:#ed8200;"><b>{{ $meeting->status }}</b></td>
                                    @elseif ($meeting->status == 'Archived')
                                    <td style="color:#f9bf00;"><b>{{ $meeting->status }}</b></td>
                                @endif
                                @if (auth()->user()->isAdmin())
                                <td class="align-self-center text-center">

                                    
                                    <a href="/meetings/{{ $meeting->id }}/show" class="btn btn-primary btn-sm">Show</a>

                                    
                                    <!-- <a href="/meetings/{{ $meeting->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                    &nbsp;
                                    &nbsp;
                                    <form method="POST" action="/meetings/{{ $meeting->id }}" style="display: inline-block;">
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
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
</script>

  <script type="text/javascript">
   $(document).ready( function () {
       $('#myTable').DataTable();
   });
</script>  

@endpush
