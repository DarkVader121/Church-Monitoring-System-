@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Edit Parish Priest Information') }}</b></div>
                <form method="POST" action="/parish-priests/{{ $priest->id }}"id="parish-priest-form">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <small small class="form-text text-danger">Warning: Editing information is strictly discouraged. Please ensure that the information you enter is accurate and correct before updating.</small>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                              <label>First Name @error('first_name')<span class="text-danger"> *</span>@enderror</label>
                              <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $priest->first_name}}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col">
                              <label>Last Name @error('last_name')<span class="text-danger"> *</span>@enderror</label>
                              <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $priest->last_name }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    
                        </div>
                        <div class="form-group ">
                          <label>Address @error('address')<span class="text-danger"> *</span>@enderror</label>
                          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $priest->address }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Contact No. @error('contact_no')<span class="text-danger"> *</span>@enderror</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">09</span>
                                </div>
                                <input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="{{ substr($priest->contact_no, 2) }}">
                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                          <label>Age @error('age')<span class="text-danger"> *</span>@enderror</label>
                          <input type="text" name="age" class="form-control @error('age') is-invalid @enderror" value="{{ $priest->age }}">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>    

                        <div class="form-group ">
                          <label>Username @error('user_name')<span class="text-danger"> *</span>@enderror</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $priest->username }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <div class="form-row">
                       <div class="form-group col-md-6">
                        <label>New Password @error('password')<span class="text-danger"> *</span>@enderror<small class="form-text text-danger">Please enter the new password of the user when needed.</small></label>
                                 <input type="password" name="password" class="form-control @error('password') is-invalid @enderror confirmed">
                                 @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                              @enderror
                                </div>

                         <div class="col">
                         <label>Confirm Password @error('password_confirmation')<span class="text-danger"> *</span>@enderror<small class="form-text text-muted">Please enter the new password again to confirm.</small></label>
                 <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror confirmed">
                 @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                     <strong>Passwords does not match.</strong>
                           </span>
                        @enderror
                </div>
                </div>


                        <div class="form-group ">
                        <label>Admin Password @error('admin_password')<span class="text-danger"> *</span>@enderror<small class="form-text text-muted">Please enter your admin password to apply changes.</small></label>
                                <input type="password" name="admin_password" class="form-control @error('admin_password') is-invalid @enderror">
                             @error('admin_password')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                        </div>

                        <div class="form-group" class="flex">
                            <button class="btn btn-outline-primary"  type="button" onclick="cancelForm()" >Cancel</button>
                            <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); validateForm()">Update</button>

                          
                            
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
    function cancelForm() {
        window.location.href = '/parish-priest';
        event.preventDefault()
    }

    function validateForm() {
        swal({
           
            text: "Are you sure you want to update user information?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then((willUpdate) => {
            if (willUpdate) {
                document.getElementById("parish-priest-form").submit();
            }
        });
    }
    </script>
@endsection