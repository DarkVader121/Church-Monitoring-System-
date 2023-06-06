@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Edit Donation') }}</b></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="/donations/{{ $donation->id }}">
                        @csrf
                        {{ method_field('PATCH') }}

                     <div class="form-group">
                        <label>Project</label>
                        <select class="form-control  @error('event') is-invalid @enderror" name="project">
                           <option disabled="" selected="" value="Select Event" >Select Project</option>
                            @foreach ($projects as $projectId => $project)
                                <option value="{{ $projectId }}">{{ $project }}</option>
                            @endforeach
                        </select>
                        @error('event')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="form-group ">
                      <label>Donor Name</label>
                      <input type="text" name="donor_name" class="form-control @error('donor_name') is-invalid @enderror" value="{{ $donation->donor_name }}">
                        @error('donor_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                    <!-- <div class="form-group ">
                      <label>First Name</label>
                      <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $donation->first_name}}">
                        @error('donor_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                    <div class="form-group ">
                      <label>Last Name</label>
                      <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $donation->last_name }}">
                        @error('donor_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>     -->

                    <div class="form-group">
                    <label>Amount <small class="text-primary">Editing the donation amount is strictly prohibited.</small></label>
                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" readonly     value="{{ $donation->amount }}">
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>


                    <div class="form-group ">
                      <label>Date</label>
                      <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"  value="{{ \Carbon\Carbon::parse($donation->date)->format('Y-m-d') }}">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                   <div class="form-group ">
                      <label>Donation Type</label>
                        <select class="form-control @error('donation_type') is-invalid @enderror" name="donation_type">
                            <option disabled="" selected="">Donation Type</option>
                            <option value="Cash"{{ $donation->donation_type == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Check"{{ $donation->donation_type == 'Check' ? 'selected' : '' }}>Check </option>
                            <option value="Gcash"{{ $donation->donation_type == 'Gcash' ? 'selected' : '' }}>Gcash</option> 
                        </select>
                        @error('donation_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>   
                       
                    <div class="form-group flex">
                         <button type="submit" class="btn btn-outline-primary" onclick="cancelForm()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function cancelForm() {
        window.location.href = '/donations';
        event.preventDefault();
    }
    </script>

    @endsection