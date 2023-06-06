@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Edit Expense') }}</b></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/expenses/{{ $expense->id }}">
                        @csrf
                        {{ method_field('PATCH') }}

                     <div class="form-group">
                        <label>Event</label>
                        <select class="form-control  @error('event') is-invalid @enderror" name="event">
                           <option disabled="" selected="" value="Select Event" >Select Event</option>
                            @foreach ($events as $eventId => $event)
                                <option value="{{ $eventId }}" {{ $expense->event_id == $eventId ? 'selected' : '' }}>{{ $event }}</option>
                            @endforeach
                        </select>
                        @error('event')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                      <div class="form-group ">
                      <label>Expense Name</label>
                      <input type="text" name="expense_name" class="form-control @error('expense_name') is-invalid @enderror" value="{{ $expense->expense_name }}">
                        @error('expense_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>   

                    <div class="form-group ">
                      <label>Date</label>
                      <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>   

                    <div class="form-group ">
                      <label>Reference Number</label>
                      <input type="text" name="reference_id" class="form-control @error('reference number') is-invalid @enderror" value="{{ $expense->reference_id }}">
                        @error('reference_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                    <div class="form-group ">
                      <label>Amount</label>
                      <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ $expense->amount }}">
                        @error('reference_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    

                  
                   

               

                    <div class="form-group mt-5">
                        <button class="btn btn-outline-primary" onclick=cancelForm()>Cancel</button>
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>

                </form>
                </div>
                </div>
                </div>
                </div>

           
        
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function cancelForm() {
        window.location.href = '/expenses';
        event.preventDefault();
    }
    </script>
        <script>
            $(document).ready(function() {
                // counter for tracking the number of inputs
                var inputCount = 2;

                // listen for button click
                $('#add-input').click(function() {
                    // create a new input group
                    event.preventDefault();
                    var newInput = '<div class="input-group input-group-sm mb-3">';
                    newInput += '<div class="input-group-prepend">';
                    newInput += '<span class="input-group-text">' + inputCount + '</span>';
                    newInput += '</div>';
                    newInput += '<input type="text" class="form-control" name="item_name[]" placeholder="Expense Name">';
                    newInput += '<input type="text" class="form-control" name="amount_item[]" placeholder="Amount">';
                    newInput += '<button type="button" class="btn btn-outline-danger btn-sm btn-remove-item">X</button>';
                    newInput += '</div>';

                    // append the new input group to the container
                    $('#input-container').append(newInput);

                    // increment the input counter
                    inputCount++;
                });

                $(document).on('click', '.btn-remove-item', function() {
                    // remove the input group from the DOM
                    $(this).closest('.input-group').remove();
                    // update the input counter
                    inputCount--;
                });
            });
        </script>


@endsection