@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="container">

     <div class="form-group">
     @if (auth()->user()->isAdmin()) 
    <div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#CreatePPCmodal">
    <i class="fa fa-plus"></i> <b>ADD PPC</b> 
    </button>
    </div>
    @endif
    </div>
@include ('ppc.modal.create')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('PPC List') }}</b></div>

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
                            @foreach ($ppcs as $ppc)
                            @php
                            $birthday = new DateTime($ppc->birthday);
                            $today = new DateTime();
                            $age = $birthday->diff($today)->y;
                            @endphp
                            <tr>
                                <td>{{ $ppc->id }}</td>
                                <td>{{ $ppc->first_name . ' ' . $ppc->last_name }}</td>
                                <td>{{ $age }} yrs old</td>
                                <td>{{ $ppc->contact_no }}</td>
                                <td>{{ $ppc->username }}</td>
                                <td>{{ $ppc->disabled ? 'Disabled' : 'Enabled' }}</td>
                                <td>
                                <a href="/ppcs/{{ $ppc->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                
                                 <a href="/ppcs/{{ $ppc->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                 &nbsp;
                                &nbsp;
                                
                                    <!-- <form method="POST" action="/ppcs/{{ $ppc->id }}/{{ $ppc->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-{{ $ppc->disabled ? 'success' : 'danger' }} btn-sm">
                                            {{ $ppc->disabled ? 'Enable User' : 'Disable User' }}
                                        </button>
                                    </form> -->
                                    <button type="submit" class="btn btn-{{ $ppc->disabled ? 'success' : 'danger' }} btn-sm" data-toggle="modal" data-target="#disable_user_{{ $ppc->id }}">
                                        {{$ppc->disabled ? 'Enable User' : 'Disable User' }}
                                    </button>
                                    @include ('ppc.modal.disabled', ['id' =>$ppc->id]) 
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

