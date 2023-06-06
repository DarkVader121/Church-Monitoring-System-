@extends('layouts.app')

@section('content')
<div class="container">

  <div class="form-group">
  @if (auth()->user()->isAdmin())
<div class="d-grid gap-2">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#CreateCommissionHead">
    <i class="fa fa-plus"></i> <b>ADD COMMISSION HEAD</b> 
    </button>
    </div>
@endif
</div>

@include ('commission-head.modal.create')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Commission Head List ') }}</b></div>

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
                            @foreach ($commissions as $commission_head)
                            <tr>
                                @php
                                $birthday = new DateTime($commission_head->birthday);
                                $today = new DateTime();
                                $age = $birthday->diff($today)->y;
                                @endphp
                                <td>{{ $commission_head->id }}</td>
                                <td>{{ $commission_head->first_name . ' ' . $commission_head->last_name }}</td>        
                                <td>{{ $age }}</td>
                                <td>{{ $commission_head->contact_no }}</td>
                                <td>{{ $commission_head->username }}</td>
                                <td>{{ $commission_head->disabled ? 'Disabled' : 'Enabled' }}</td>
                                <td>
                                       <a href="/commission-heads/{{$commission_head->id}}/show" class="btn btn-primary btn-sm">Show</a>
                                      
                                    <a href="/commission-heads/{{ $commission_head->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                    &nbsp;
                                       &nbsp;
                                    <!-- <form method="POST" action="/commission-heads/{{ $commission_head->id }}/{{ $commission_head->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-{{ $commission_head->disabled ? 'success' : 'danger' }} btn-sm">
                                            {{ $commission_head->disabled ? 'Enable User' : 'Disable User' }}
                                        </button>
                                    </form> -->

                                   
                                 <button type="submit" class="btn btn-{{$commission_head->disabled ? 'success' : 'danger' }} btn-sm" data-toggle="modal" data-target="#disable_user_{{ $commission_head->id }}">
                                        {{ $commission_head->disabled ? 'Enable User' : 'Disable User' }}
                                    </button>
                                    @include ('commission-head.modal.disabled', ['id' => $commission_head->id]) 
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
