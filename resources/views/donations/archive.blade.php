@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #f9bf00;  color:white;"><b>{{ __('View Information') }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Donor Name</th>
                                <th>Donation Type</th>
                                <th>Amount</th>
                                <th>Date Created</th>
                                <th>Date Archived</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->event ? $donation->event->event_name : 'No event' }}</td>
                                    <td>{{ $donation->donor_name }}</td>
                                    <td>{{ $donation->donation_type }}</td>
                                    <td>₱{{ number_format($donation->amount, 0, '.', ',') }}</td>
                                    <td>{{ $donation->date->toFormattedDateString() }}</td>
                                    <td>{{ date('M d Y', strtotime($donation->updated_at)) }}</td>
                                </tr>
                            @endforeach
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
