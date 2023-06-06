@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Generate Donation Reports') }}</b></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                        $totalAmount = 0;
                    @endphp
                                @foreach ($donations as $donation)
                                                @php
                                                $totalAmount += $donation->amount;
                                                @endphp
                                @endforeach
                  
                                <label> Categorize by Project</label>
                                <div class="card w-100" style="width: 18rem;">
                                    <ul class="list-group list-group-flush">
                                    <form action="{{ url('/donation-reports') }}" method="GET">
                                        <select class="form-control" name="project_filter">
                                            <option value="All Approved Projects" {{ $selectedProject === 'All Approved Projects' ? 'selected' : '' }}>All Approved Projects</option>
                                            @foreach ($projects as $projectID => $project)
                                                <option value="{{ $projectID  }}" {{ $selectedProject == $projectID  ? 'selected' : '' }}>{{ $projectID }}. {{ $project }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_filter')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </ul>
                                    </div>


                        <form>
                          <div class="row">
                            <div class="col">
                                <label>From</label>
                                <input id="from" type="date" class="form-control" name="from" value="{{ request('from') }}">
                                @error('from')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div> 
                            <div class="col">
                                <label>To</label>
                                <input id="to" type="date" class="form-control" name="to" value="{{ request('to') }}">
                                @error('to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                          </div>
                            <br>
                          <div class="form-group">
                              <button type="submit" class="btn btn-outline-primary"> <b> Generate</button></b>
                          </div>
                        </form>
                   </div>
                </div>
            </div>
            </div> 
                 <center class="mt-2 mb-3">
                @if (request()->has('from') && request()->has('to'))
                    <h3>Total Donation Amount Generated: ₱{{ number_format($totalAmount, 0, '.', ',') }}.00</h3>
                @else
                    <h3>Total Donation Amount Generated: ₱0.00</h3>
                @endif
                </center>


          <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('Reports') }}</b></div>
                <div class="card-body">
                <div class="form-group">
                    <a href="{{ route('pdf-donation', ['from' => request('from'), 'to' => request('to'), 'project_filter' => request('project_filter')]) }}" class="btn btn-outline-primary" style="display: inline-block;"><b>PDF</b></a>
                </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                    $totalAmount = 0;
                    @endphp
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Linked Project</th>
                                <th>Donor Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @if (request()->has('from') || request()->has('to'))
                                @foreach ($donations as $donation)
                                @php
                                $totalAmount += $donation->amount;
                                @endphp
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->project ? $donation->project->project_name : '' }}</td>
                                    <td>{{ $donation->donor_name}}</td>
                                    <td>{{ $donation->date->toFormattedDateString() }}</td>
                                    <td>₱ {{ number_format($donation->amount, 0, '.', ',' ) }}</td>
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

