@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;">{{ __('Update Phone Number') }}</div>
                <form method="POST" action="/update-phone" id="update-phone-form">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       

                        <div class="form-group ">
                        <label>Please enter your contact number below:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">09</span>
                                </div>
                          <input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="{{ substr(auth()->user()->contact_no, 2)}}">
                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary" onclick="cancelForm()" >Cancel</button>
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
        window.location.href = '/home';
        event.preventDefault();
    }

    function validateForm() {
        swal({
           
            text: "Are you sure you want to update contact information?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then((willUpdate) => {
            if (willUpdate) {
                document.getElementById("update-phone-form").submit();
            }
        });
    }
    </script>
@endsection