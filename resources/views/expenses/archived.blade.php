@extends('layouts.app')

@section('content')
<div class="container">

<div class="form-group">
  
 
 

     <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-header"style="background-color: #f9bf00;  color:white;"><b>{{ __('Archived Expenses list') }}</b></div>
                <div class="card-body">
                    

                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Expense Name</th>
                               
                                <th>Amount</th>
                                <th>Reference Number</th>
                                <th>Create Date</th>
                                <th>Archive Date</th>
                                <th>Action</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->event ? $expense->event->event_name : '' }}</td>
                                <td>{{ $expense->expense_name }}</td>
                                
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->reference_id}}</td>
                                <td>{{ $expense->date->toFormattedDateString() }}</td>
                                <td>{{ date('M d Y', strtotime($expense->updated_at)) }}</td>
                                <td class="align-self-center text-center">
                                     <a href="/expenses/{{ $expense->id }}/show" class="btn btn-primary btn-sm">Show</a>
                                </td>
                                
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
@endpush
