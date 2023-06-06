@extends('layouts.app')

@section('content')


<div class="container">
<div class="form-group">
@if (auth()->user()->isPfcAdmin() || auth()->user()->isAdmin())
<div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
  <i class="fa fa-plus"></i> <b>ADD PFC Chairman</b> 
    </button>
    </div>
@endif
</div>

@include ('usersPFC.modal.create')



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('PFC Chairman lists') }}</b></div>

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
                                <th>Age</th>
                               
                               
                                <th>User Status</th>
                                @if (auth()->user()->isAdmin())
                                <th>Action</th>
                                @endif
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pfc_chairmans as $pfc_chairman)
                            @php 
                        $birthday = new DateTime($pfc_chairman->birthday);
                        $today = new DateTime();
                        $age = $birthday->diff($today)->y;
                        @endphp
                            <tr>
                                <td>{{ $pfc_chairman->id }}</td>
                                <td>{{ $pfc_chairman->username }}</td>
                                <td>{{ $pfc_chairman->first_name . ' ' . $pfc_chairman->last_name }}</td>
                                <td>{{ $pfc_chairman->address }}</td>
                                <td>{{ $age }} yrs old</td>
                             
                                <td>{{ $pfc_chairman->disabled ? 'Disabled' : 'Enabled' }}</td>
                                @if (auth()->user()->isAdmin())
                                <td>
                                <a href="/pfc_chairmans/{{ $pfc_chairman->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                <a href="{{ route('pfc_chairmans.edit', $pfc_chairman->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                 &nbsp;
                                &nbsp;
                                 <!-- <form method="POST" action="/pfc_chairmans/{{ $pfc_chairman->id }}/{{ $pfc_chairman->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-{{ $pfc_chairman->disabled ? 'success' : 'danger' }} btn-sm">
                                            {{ $pfc_chairman->disabled ? 'Enable User' : 'Disable User' }}
                                        </button>
                                 </form> -->
                               
                                 <button type="submit" class="btn btn-{{ $pfc_chairman->disabled ? 'success' : 'danger' }} btn-sm" data-toggle="modal" data-target="#disable_user_{{ $pfc_chairman->id }}">
                                        {{ $pfc_chairman->disabled ? 'Enable User' : 'Disable User' }}
                                    </button>
                                    @include ('usersPFC.modal.disabled', ['id' => $pfc_chairman->id]) 
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


