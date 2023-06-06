@extends('layouts.app')

@section('content')
<div class="container">



<div class="form-group">
@if (auth()->user()->isAdmin())

<div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#CreateParishPriest">
   <i class="fa fa-plus"></i> <b>ADD PARISH PRIEST</b> 
    </button>
    </div>

</button>


@endif
</div>

@include ('parish-priest.modal.create')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Priest lists') }}</b></div>
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
                                @if (auth()->user()->isAdmin())
                                <th>Action</th>
                               @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($priests as $priest)
                            @php 
                            $birthday = new DateTime($priest->birthday);
                            $today = new DateTime();
                            $age = $birthday->diff($today)->y;
                            @endphp
                            <tr>
                                <td>{{ $priest->id }}</td>
                                <td>{{ $priest->first_name . ' ' . $priest->last_name }}</td>
                                <td>{{ $age }} yrs old</td>
                                <td>{{ $priest->contact_no }}</td>
                                <td>{{ $priest->username }}</td>
                                <td>{{ $priest->disabled ? 'Disabled' : 'Enabled' }}</td>
                                @if (auth()->user()->isAdmin())
                                <td>
                                
                                <a href="/parish-priests/{{ $priest->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                 <a href="/parish-priests/{{ $priest->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                 &nbsp;
                                &nbsp;
                                
                                    <!-- <form method="POST" action="/parish-priests/{{ $priest->id }}/{{ $priest->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-{{ $priest->disabled ? 'success' : 'danger' }} btn-sm">
                                            {{ $priest->disabled ? 'Enable User' : 'Disable User' }}
                                        </button>
                                    </form> -->
                                    <button type="submit" class="btn btn-{{ $priest->disabled ? 'success' : 'danger' }} btn-sm" data-toggle="modal" data-target="#disable_user_{{ $priest->id }}">
                                        {{ $priest->disabled ? 'Enable User' : 'Disable User' }}
                                    </button>
                                    @include ('parish-priest.modal.disabled', ['id' => $priest->id]) 
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


