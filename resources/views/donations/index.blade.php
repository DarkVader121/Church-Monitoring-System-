@extends('layouts.app')

@section('content')
<div class="container">

    @if (auth()->user()->isAdmin() || auth()->user()->isPfc() || auth()->user()->isPfcAdmin())
    <div class="d-grid">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-plus"></i> <b>ADD DONATION</b> 
    </button>
    </div>
    @endif
    @include ('donations.modal.create')

    @php
        $totalAmount = 0;
    @endphp
                 @foreach ($donations as $donation)
                                 @php
                                $totalAmount += $donation->amount;
                                 @endphp
                 @endforeach
 
                 <div class="row ">
                    <div class="col-md-3 mr-5">
                        <div class="card mt-3" style="width: 18rem;">
                        <div class="card-header" style="background-color: #2580ff; color:white;">
                            <b>Categorize by Project </b>
                        </div>
                        <ul class="list-group list-group-flush">
                            <form action="{{ url('/donations') }}" method="GET">
                         
                        <select class="form-control  @error('event') is-invalid @enderror" name="project">
                           <option value="" >All Approved Projects</option>
                            @foreach ($projects as $projectId => $project)
                                <option value="{{ $projectId }}" {{ Request::get('project') == $projectId ? "selected":" "}}>{{ $project }}</option>
                            @endforeach
                        </select>
                            <div class="d-grid gap-2 d-md-block">
                                <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                            </div>
                            </form>
                        </ul>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mt-3 card text-center">
                        <div class="card-header" style="background-color: #2580ff; color:white;">
                            <h5>Total Amount of Donations</h5>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">₱{{ number_format($totalAmount, 0, '.', ',') }}.00</h2>
                            <p class="card-text">The amount that the Lila Holy Rosary Parish had raised through donations as of <?php echo date('F j, Y'); ?></p>
                        </div>
                        </div>
                    </div>
                    </div>




      <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('View Information') }}</b></div>

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
                                <th>Project</th>
                                <th>Donor Name</th>
                                <th>Donation Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                @if (auth()->user()->isAdmin() || auth()->user()->isPfc() || auth()->user()->isPfcAdmin() )
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->project_id ? $donation->project->project_name : 'No project' }}</td>
                                    <td>{{ $donation->donor_name}}</td>
                                    <td>{{ $donation->donation_type }}</td>
                                    <td>₱{{ number_format($donation->amount, 0, '.', ',' ) }}</td>
                                    <td>{{ $donation->date->toFormattedDateString() }}</td>
                                    @if (auth()->user()->isAdmin() || auth()->user()->isPfc() || auth()->user()->isPfcAdmin() )
                                    <td class="align-self-center text-center">
                                        <a href="/donations/{{ $donation->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                        &nbsp;
                                       
                                        <form method="POST" action="/donations/{{ $donation->id }}/archive" style="display: inline-block;">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="sweetAlertConfirmation({{ $donation->id }})">Archive</button>
                                        </form>
                                      
                                        <!-- <form method="POST" action="/donations/{{ $donation->id }}" style="display: inline-block;">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form> -->
                                    </td>

                                  
                                    @endif
                                </tr>
                                @php
                                $totalAmount += $donation->amount;
                                 @endphp
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
   $(document).ready( function () {
       $('#myTable').DataTable();
   });
</script>  
<script>
  function sweetAlertConfirmation(id) {
    swal({
      title: "Are you sure you want to archive this donation?",
      text: "Once archived, the donation cannot be unarchived.",
      icon: "warning",
      buttons: ["No", "Yes"],
      dangerMode: true,
    })
    .then((willArchive) => {
      if (willArchive) {
        $('form[action="/donations/' + id + '/archive"]').submit();
      }
    });
  }
</script>


@endpush
