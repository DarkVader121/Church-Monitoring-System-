@extends('layouts.app')

@section('content')
<div class="container">
 

<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('View Information') }}</b></div>
                <form method="POST" action="/commission-heads/{{ $commission_head->id }}">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-row">
                        <div class="form-group col-md-6">
                              <label>First Name</label>
                              <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" style="color: black;"disabled value="{{ $commission_head->first_name}}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col">
                              <label>Last Name</label>
                              <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"  style="color: black;"disabled value="{{ $commission_head->last_name }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    
                        </div>
                        <div class="form-group ">
                          <label>Address</label>
                          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"style="color: black;" disabled value="{{ $commission_head->address }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Contact No.</label>
							<input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" style="color: black;" disabled value="{{ $commission_head->contact_no }}">
                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                @php
                                $birthday = new DateTime($commission_head->birthday);
                                $today = new DateTime();
                                $age = $birthday->diff($today)->y;
                                @endphp
                     
                        <div class="col">
                          <label>Age</label>
                          <input type="text" name="age" class="form-control @error('age') is-invalid @enderror"style="color: black;" disabled value="{{ $age }}">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>    

                        <div class="form-group ">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" style="color: black;"disabled value="{{ $commission_head->username }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
						
						<div class="form-row">
                        <div class="form-group col-md-6">
                              <label>Date Created</label>
                              <input type="text" name="created_at" class="form-control @error('first_name') is-invalid @enderror" style="color: black;"disabled value="{{ date('M j, Y', strtotime($commission_head->created_at )) }}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col">
                              <label>Date Updated</label>
                              <input type="text" name="updated_at" class="form-control @error('last_name') is-invalid @enderror" style="color: black;"disabled value="{{ date('M j, Y', strtotime($commission_head->updated_at )) }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
						</div>
                        <div class="form-group" class="flex">
                            <button class="btn btn-outline-primary" type="button" onclick="cancelForm()" >Back</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
    function cancelForm() {
        window.location.href = '/commission-heads';
    }
    </script>
@endsection