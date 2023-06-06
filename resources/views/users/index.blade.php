@extends('layouts.app')

@section('content')


<div class="container">
<div class="form-group">
@if (auth()->user()->isAdmin())
<div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
  <i class="fa fa-plus"></i> <b>ADD CHAIRMAN</b> 
    </button>
    </div>
@endif
</div>

@include ('users.modal.create')



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Chairman lists') }}</b></div>

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
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Address</th>
                                <!-- <th>Age</th> -->
                               
                               
                                <th>User Status</th>
                                @if (auth()->user()->isAdmin())
                                <th>Action</th>
                                @endif
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chairmans as $chairman)
                            @php 
                        $birthday = new DateTime($chairman->birthday);
                        $today = new DateTime();
                        $age = $birthday->diff($today)->y;
                        @endphp
                            <tr>
                                <td>{{ $chairman->id }}</td>
                                <td>{{ $chairman->username }}</td>
                                <td>{{ $chairman->first_name . ' ' . $chairman->last_name }}</td>
                                <td>{{ $chairman->address }}</td>
                                <!-- <td>{{ $age }} yrs old</td> -->
                             
                                <td>{{ $chairman->disabled ? 'Disabled' : 'Enabled' }}</td>
                                @if (auth()->user()->isAdmin())
                                <td>
                                <a href="/chairmans/{{ $chairman->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                 <a href="/chairmans/{{ $chairman->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                 &nbsp;
                                &nbsp;
                                 <!-- <form method="POST" action="/chairmans/{{ $chairman->id }}/{{ $chairman->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-{{ $chairman->disabled ? 'success' : 'danger' }} btn-sm">
                                            {{ $chairman->disabled ? 'Enable User' : 'Disable User' }}
                                        </button>
                                 </form> -->
                               
                                 <button type="submit" class="btn btn-{{ $chairman->disabled ? 'success' : 'danger' }} btn-sm" data-toggle="modal" data-target="#disable_user_{{ $chairman->id }}">
                                        {{ $chairman->disabled ? 'Enable User' : 'Disable User' }}
                                    </button>
                                    @include ('users.modal.disabled', ['id' => $chairman->id]) 
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
@push ('scripts')

  <script type="text/javascript">
   $(document).ready( function () {
       $('#myTable').DataTable();
   });

  
</script>  


@endpush


@endsection


