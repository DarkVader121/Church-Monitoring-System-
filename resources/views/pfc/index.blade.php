@extends('layouts.app')

@section('content')
<div class="container">

<div class="form-group">
@if ( auth()->user()->isPfcAdmin())
<div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#CreatePfcModal">
    <i class="fa fa-plus"></i> <b>ADD PFC</b> 
    </button>
    </div>
@endif
</div>

@include ('pfc.modal.create')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('PFC List') }}</b></div>
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
                                
                                <th>Full Name</th>
                              
                                <th>Age</th>
                                <th>Contact No. </th>
                                <th>Username</th>
                                <th>User Status</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pfcs as $pfc)
                            @php
                            $birthday = new DateTime($pfc->birthday);
                            $today = new DateTime();
                            $age = $birthday->diff($today)->y;
                            @endphp
                            <tr>
                                <td>{{ $pfc->id }}</td>
                                <td>{{ $pfc->first_name . ' ' . $pfc->last_name }}</td>
                               
                                <td>{{ $age }} yrs old</td>
                                <td>{{ $pfc->contact_no }}</td>
                                <td>{{ $pfc->username }}</td>
                                <td>{{ $pfc->disabled ? 'Disabled' : 'Enabled' }}</td>
                                <td>
                                <a href="/pfcs/{{ $pfc->id }}/show" class="btn btn-primary btn-sm">Show</a>
                               
                                 <a href="/pfcs/{{ $pfc->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                 &nbsp;
                                &nbsp;
                                
                                    <!-- <form method="POST" action="/pfcs/{{ $pfc->id }}/{{ $pfc->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-{{ $pfc->disabled ? 'success' : 'danger' }} btn-sm">
                                            {{ $pfc->disabled ? 'Enable User' : 'Disable User' }}
                                        </button>
                                    </form> -->
                                    <button type="submit" class="btn btn-{{ $pfc->disabled ? 'success' : 'danger' }} btn-sm" data-toggle="modal" data-target="#disable_user_{{ $pfc->id }}">
                                        {{ $pfc->disabled ? 'Enable User' : 'Disable User' }}
                                    </button>
                                    @include ('pfc.modal.disabled', ['id' => $pfc->id]) 
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

