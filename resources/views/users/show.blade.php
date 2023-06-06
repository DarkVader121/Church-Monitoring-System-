@extends('layouts.app')

@section('content')


<div class="container">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('View Information') }}</b></div>
                <form method="POST" action="/chairmans/{{ $chairman->id }}" id="chairman-form">
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
                              <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" style="color: black;"disabled value="{{ $chairman->first_name}}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col">
                              <label>Last Name</label>
                              <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"  style="color: black;"disabled value="{{ $chairman->last_name }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    
                        </div>
                        <div class="form-group ">
                          <label>Address</label>
                          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"style="color: black;" disabled value="{{ $chairman->address }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Contact No.</label>
							<input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" style="color: black;" disabled value="{{ $chairman->contact_no }}">
                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @php 
                        $birthday = new DateTime($chairman->birthday);
                        $today = new DateTime();
                        $age = $birthday->diff($today)->y;
                        @endphp
                        <div class="col">
                          <label>Age</label>
                          <input type="text" name="age" class="form-control @error('age') is-invalid @enderror"style="color: black;" disabled value="{{ $age}} yrs old">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>    

                        <div class="form-group ">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" style="color: black;"disabled value="{{ $chairman->username }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  

                        <div class="form-group ">
                          <label>Email Address</label>
                          <input type="text" name="email" class="form-control @error('username') is-invalid @enderror" style="color: black;"disabled value="{{ $chairman->email }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
						
						<div class="form-row">
                        <div class="form-group col-md-6">
                              <label>Date Created</label>
                              <input type="text" name="created_at" class="form-control @error('first_name') is-invalid @enderror" style="color: black;"disabled value="{{ date('M j, Y', strtotime($chairman->created_at )) }}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col">
                              <label>Date Updated</label>
                              <input type="text" name="updated_at" class="form-control @error('last_name') is-invalid @enderror" style="color: black;"disabled value="{{ date('M j, Y', strtotime($chairman->updated_at )) }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
						</div>
                        <div class="form-group" class="flex">
                        <button class="btn btn-outline-primary" type="button" onclick="cancelForm()">Back</button>
                        
                        <a class="btn btn-primary" href="{{ route('send-credentials', ['chairman' => $chairman->id]) }}">Email Credentials</a>

                 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
    function cancelForm() {
        window.location.href = '/chairmans';
    }
    </script>

@endsection