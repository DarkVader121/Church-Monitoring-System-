@extends('layouts.app')

@section('content')
<div class="container">

<div class="form-group">
    @if (auth()->user()->isAdmin() || auth()->user()->isPfc() || auth()->user()->isPfcAdmin() )
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">
     <i class="fa fa-plus"></i> <b>ADD EXPENSE</b> 
    </button>
    </div>
    @endif
@include ('expenses.modal.create')
  
    @php
        $totalAmount = 0;
    @endphp
                 @foreach ($expenses as $expense)
                                 @php
                                $totalAmount += $expense->amount;
                                 @endphp
                 @endforeach

                
                 <div class="card mb-3">
                    <div class="card-header" style="background-color: #2580ff; color:white;">
                        <b>Categorize by Event</b>
                    </div>
                    <ul class="list-group list-group-flush">
                        <form action="{{ url('/expenses') }}" method="GET">
                        <select class="form-control" name="event_filter">
                            <option>All Approved Events</option>                        
                                @foreach ($events as $eventID => $eventName)
                            <option value="{{ $eventID }}" {{ Request::get('event_filter')  == $eventID ? "selected":" "}}> {{ $eventName }}</option>                            
                                @endforeach
                        </select>


                    
                        <div class="d-grid gap-2 d-md-block">
                            <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                        </div>
                        </form>
                    </ul>
                    </div>

                

<div class="row">
 <div class="col-md-6">
                            <div class="card text-center">
                            <div class="card-header"style="background-color: #2580ff; color:white;">
                                   <h5>Total Expenses of <i>  {{ $selectedEvent === 'All Approved Events' ? 'All Approved Events' : $selectedEvent }}</i></h5>
                             </div>
                        <div class="card-body">
                            <h2 class="card-title">₱{{ number_format($totalAmount, 0, '.', ',' ) }}.00</h2>
                            <p class="card-text">The amount spent by the Lila Holy Rosary Parish on events as of <?php echo date('F j, Y'); ?></p>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="card text-center">
                            <div class="card-header"style="background-color: #2580ff; color:white;">
                                   <h5>Total Donations of <i>    {{ $selectedEvent === 'All Approved Events' ? 'All Approved Events' : $selectedEvent }}</i></h5>
                             </div>
                        <div class="card-body">
                            <h2 class="card-title">₱{{ number_format($totalDonation, 0, '.', ',' ) }}.00</h2>
                            <p class="card-text">The amount donation by the Lila Holy Rosary Parish on events as of <?php echo date('F j, Y'); ?></p>
                        </div>
                    </div>
                   
                  <!-- the previous value cannot be retain -->
                  </div>
                  </div>             
                      

                  
     <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Expense List') }}</b></div>

                <div class="card-body">
                    

                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Event</th> -->
                                <th>Expense Name</th>
                                <th>Amount</th>
                                <th>Reference Number</th>
                                <th>Create Date</th>
                                <th>Options</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <!-- <td>{{ $expense->event ? $expense->event->event_name : '' }}</td> -->
                                <td>{{ $expense->expense_name }}</td>
                             
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->reference_id}}</td>
                                <td>{{ $expense->date->toFormattedDateString() }}</td>
                                
                                @if (auth()->user()->isAdmin() || auth()->user()->isPfc() || auth()->user()->isPfcAdmin())
                                <td class="align-self-center text-center">
                                     <a href="/expenses/{{ $expense->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                    <a href="/expenses/{{ $expense->id }}/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                    &nbsp;
                                    &nbsp;

                                    <form method="POST" action="/expenses/{{ $expense->id }}/archive" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="sweetAlertConfirmation({{ $expense->id }})">Archive</button>
                                        </form>

                                   
                                    <!-- <form method="POST" action="/expenses/{{ $expense->id }}" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form> -->
                                </td>
                                @endif

                                @if (auth()->user()->isParish() || auth()->user()->isCommissionHead() || auth()->user()->isPpc())
                                <td class="align-self-center text-center">
                                     <a href="/expenses/{{ $expense->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                   </div>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<script>
  function sweetAlertConfirmation(id) {
    swal({
      title: "Are you sure you want to archive this expense?",
      text: "Once archived, the donation cannot be unarchived.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/expenses/' + id + '/archive"]').submit();
      }
    });
  }
</script>
@endpush
