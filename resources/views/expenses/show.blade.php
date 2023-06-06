@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('View Information') }}</b></div>

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
                        <select  disabled class="form-control  @error('event') is-invalid @enderror" name="event">
                           <option disabled="" selected="" value="Select Event" >Select Event</option>
                            @foreach ($events as $eventId => $event)
                                <option value="{{ $eventId }}" {{ $expense->event_id == $eventId ? 'selected' : '' }}>{{ $event }}</option>
                            @endforeach
                        </select>
                     
                    </div>

                      <div class="form-group ">
                      <label>Expense Name</label>
                      <input disabled type="text" name="expense_name" class="form-control @error('expense_name') is-invalid @enderror" value="{{ $expense->expense_name }}">
                        
                      </div>   

                      <div class="form-group">
                        <label>Description</label>
                        <textarea disabled class="form-control @error('date') is-invalid @enderror" style="height: 150px; vertical-align: top;">{{ $expense->description }}</textarea>
                        </div>

                    <div class="form-group ">
                      <label>Date</label>
                      <input disabled type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}">
                        
                    </div>   

                    <div class="form-group ">
                      <label>Reference Number</label>
                      <input disabled type="text" name="reference_id" class="form-control @error('reference number') is-invalid @enderror" value="{{ $expense->reference_id }}">
                        
                    </div>    
                    <div class="form-group ">
                      <label>Amount</label>
                      <input disabled type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ $expense->amount }}">
                       
                    </div>    
                    <div class="form-group ">
                      <label>Create Date</label>
                      <input disabled type="text"  class="form-control @error('amount') is-invalid @enderror" value="{{ date('M d Y', strtotime($expense->created_at)) }}">
                       
                    </div>    
                    <div class="form-group ">
                      <label>Archived Date</label>
                      <input disabled type="text"  class="form-control @error('amount') is-invalid @enderror" value="{{ date('M d Y', strtotime($expense->updated_at)) }}">
                       
                    </div>    

                
                        
                    </div>
                    
                </form>
                <div class="form-group">
                <button type="button" class="btn btn-primary ml-2" onclick=cancelForm()>Back</button>
                </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function cancelForm() {
        window.history.back();
        event.preventDefault();
    }
</script>

@endsection