@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;">{{ __('Profile') }}</div>
                <form method="POST" action="/settings">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group ">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" disabled value="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}">
                            </div>

                            <div class="form-group ">
                          <label>Address</label>
                          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" disabled value="{{ auth()->user()->address }}">

                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Contact No</label>
                          <input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" disabled value="{{ auth()->user()->contact_no }}">

                        </div>  
                     
                        <div class="col">
                          <label>Age</label>
                          <input type="text" name="age" class="form-control @error('age') is-invalid @enderror" disabled value="{{ auth()->user()->age }}">
                        </div>  
                        </div>  
                        <div class="form-row">
                        <div class="form-group col-md-1">
                                
                                <label>ID</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="id" disabled value="{{ auth()->user()->id }}">
                                
                          </div>

                        <div class="col">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" disabled value="{{ auth()->user()->username }}">
                          </div> 
                        </div>  

                        <div class="form-group">
                            <button class="btn btn-primary" onclick="cancelForm()" >Back</button>
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