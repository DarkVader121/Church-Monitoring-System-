@extends('layouts.app')

@section('content')
<div class="container">

     
                  


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header" style="background-color: #f9bf00;  color:white;"><b>{{ __('Archived Meeting List') }}</b></div>

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
                                <td style="color: #f9bf00;"><b>{{ $meeting->status }}</b></td>
                                @if (auth()->user()->isAdmin() )
                                <td class="align-self-center text-center">
                                    <a href="/meetings/{{ $meeting->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                </td>
                                @endif

                                @if (auth()->user()->isPpc() || auth()->user()->isCommissionHead() || auth()->user()->isPpc())
                                <td class="align-self-center text-center">

                                    
                                    <a href="/meetings/{{ $meeting->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                    <a href="/meetings/{{ $meeting->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
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

@endpush
