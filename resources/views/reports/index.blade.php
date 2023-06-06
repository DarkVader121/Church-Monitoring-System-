@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Generate Expense Report') }}</b></div>
                <div class="card-body items-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                        $totalAmount = 0;
                    @endphp
                                @foreach ($expenses as $expense)
                                                @php
                                                $totalAmount += $expense->amount;
                                                @endphp
                                @endforeach
                    
                                <label> Categorize by Event </label>
                                <div class="card w-100" style="width: 18rem;">
                                    <ul class="list-group list-group-flush">
                                    <form action="{{ url('/reports') }}" method="GET">
                                        <select class="form-control" name="event_filter">
                                            <option disabled selected value="Select Event">Select Approved Event</option>
                                            <option value="All Donations" {{ $selectedEvent === 'All Donations' ? 'selected' : '' }}>All Approved Events</option>
                                            @foreach ($events as $eventID => $eventName)
                                                <option value="{{ $eventID }}" {{ $selectedEvent == $eventID ? 'selected' : '' }}>{{ $eventID }}. {{ $eventName }}</option>
                                            @endforeach
                                        </select>

                                    
                                    </ul>
                                    </div>
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <label>From</label>
                                                <input id="from" type="date" class="form-control @error('from') is-invalid @enderror" name="from" value="{{ request('from') }}" >
                                                @error('from')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div> 
                                            <div class="col">
                                                <label>To</label>
                                                <input id="to" type="date" class="form-control @error('to') is-invalid @enderror" name="to" value="{{ request('to') }}" >
                                                @error('to')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-primary"><b>Generate</b></button>
                                        </div>
                                    </form>

                         
                   </div>
                </div>
            </div>
            </div> 
            <center class="mt-2 mb-3">
                @if (request()->has('from') && request()->has('to'))
                    <h3>Total Expense Amount Generated: ₱{{ number_format($totalAmount, 0, '.', ',') }}.00</h3>
                @else
                    <h3>Total Expense Amount Generated: ₱0.00</h3>
                @endif
                </center>
          
          <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Reports') }}</b></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                    $totalAmount = 0;
                    @endphp
                    <div class="form-group">
                        <a href="{{ route('pdf', ['from' => request('from'), 'to' => request('to'), 'event_filter' => request('event_filter')]) }}" class="btn btn-outline-primary" style="display: inline-block;"><b>PDF</b></a>
                    </div>


                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Linked Event Name</td> -->
                                <th>Expense Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if (request()->has('from') || request()->has('to'))
                                @foreach ($expenses as $expense)
                                <!-- @php
                                $totalAmount += $expense->amount;
                                @endphp -->
                                <tr>
                                    <td>{{ $expense->id }}</td>
                                    <!-- <td>{{ $expense->event ? $expense->event->event_name : '' }}</td> -->
                                    <td>{{ $expense->expense_name }}</td>
                                    <td>{{ $expense->date->toFormattedDateString() }}</td>
                                    <td>₱ {{ number_format($expense->amount, 0, '.', ',' ) }}</td>
                                </tr>
                                @endforeach
                                
                            @endif
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

