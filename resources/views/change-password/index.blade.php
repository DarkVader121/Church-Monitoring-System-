@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;">{{ __('Change Password') }}</div>
                <form method="POST" action="/change-password">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
   
                        <div class="form-group">
                        <label>Current Password</label>
                         <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                             @error('current_password')
                               <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                          </span>
                     @enderror
                     
                     <br>

                    </div>
                        <div class="form-group ">
                          <label> New Password</label>
                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                          <label>Confirm Password</label>
                          <input type="password" name="password_confirmation" class="form-control @error('confirm_password') is-invalid @enderror">
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-outline-primary" onclick="cancelForm()" >Cancel</button>
                            <button type="submit" class="btn btn-primary"  >Update</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>

    <script>
    function cancelForm() {
        window.location.href = '/home';
        event.preventDefault();
    }
    </script>
@endsection
