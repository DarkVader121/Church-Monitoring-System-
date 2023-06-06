@extends('layouts.app')
@inject('stats','App\Stats') 
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div id="content" class="mr-5" style="margin-left: 240px !important;">
<center><h4 " style="font-weight: bold; color: #4592e5;">DASHBOARD</h4></center>

<div class="row ">
<div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-tasks"></i></div><div class="stats-info"><h3>Total Number of Projects</h3><p>{{$stats->totalProjects()}}</p></div><div class="stats-link"><a href="/projects">View Details</a></div></div></div>
<div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-calendar"></i></div><div class="stats-info"><h3>Total Number of Events</h3><p>{{$stats->totalEvents()}}</p></div><div class="stats-link"><a href="/events">View Details</a></div></div></div>

<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-thumbs-o-up"></i></div><div class="stats-info"><h3>Approved </h3><p>Projects: {{$stats->totalProjects()}}</p></div><div class="stats-link"><a href="/approved-projects">View Details</a></div></div></div>
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-clock"></i></div><div class="stats-info"><h3>Pending</h3><p>Projects: {{$stats->totalApprovedProjects()}}</p></div><div class="stats-link"><a href="/pending-projects">View Details</a></div></div></div>
<!-- <div class="col-lg-2 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-clock"></i></div><div class="stats-info"><h3>Cancelled </h3><p>Projects: {{$stats->totalPendingProjects()}}</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div> -->
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-thumbs-o-up"></i></div><div class="stats-info"><h3>Approved </h3><p>Events: {{$stats->totalApprovedEvents()}}</p></div><div class="stats-link"><a href="/approved-events">View Details</a></div></div></div>
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-clock"></i></div><div class="stats-info"><h3>Pending </h3><p>Events: {{$stats->totalPendingEvents()}}</p></div><div class="stats-link"><a href="/pending-events">View Details</a></div></div></div>
<!-- <div class="col-lg-2 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-clock"></i></div><div class="stats-info"><h3>Cancelled </h3><p>Events: {{$stats->totalCancelledEvents()}}</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div> -->
<div class="col-lg-6 col-sm-6 mx-auto">
<div class="card">
 
  <div class="card-body">

  <table class="table  table-bordered" id="myTable">
  <thead class="bg-primary" style="color: white;">
    <tr>
      <th scope="col">Project ID</th>
      <th scope="col">Project Name</th>
      <th scope="col">Project Status</th>
      <th scope="col">Budget</th>
    </tr>
  </thead>
  <tbody>
                         @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->project_name }}</td>
                                    @if ($project->status == 'Approved')
                                    <td style="color:green; "><b>{{ $project->status }}</b></td>
                                    @elseif ($project->status == 'Cancelled')
                                    <td style="color:red;"><b>{{ $project->status }}</b></td>
                                    @elseif ($project->status == 'Pending')
                                    <td style="color:#ed8200;"><b>{{ $project->status }}</b></td>
                                    @elseif ($project->status == 'Archived')
                                    <td style="color:#f9bf00;"><b>{{ $project->status }}</b></td>
                                    @endif
                                    <td>₱ {{ number_format($project->budget, 0, '.', ',') }}</td>

                             
                            </tr>
                            @endforeach
  </tbody>
</table>
</div>
</div>
</div>


<div class="col-lg-6 col-sm-6 mx-auto">
<div class="card ">
 
  <div class="card-body">
  <table class="table  table-bordered" id="myTablee">
  <thead class="bg-primary" style="color: white;">
    <tr>
      <th scope="col">Event ID</th>
      <th scope="col">Event Name</th>
      <th scope="col">Linked Project</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->event_name }}</td> 
                                <td>{{ $event->project ? $event->project->project_name : '' }}</td>
                               
                                @if ($event->status == 'Approved')
                                    <td style="color:green; "><b>{{ $event->status }}</b></td>
                                @elseif ($event->status == 'Cancelled')
                                    <td style="color:red;"><b>{{ $event->status }}</b></td>
                                @elseif ($event->status == 'Pending')
                                    <td style="color:#ed8200;"><b>{{ $event->status }}</b></td>
                                    @elseif ($event->status == 'Archived')
                                    <td style="color:#f9bf00;"><b>{{ $event->status }}</b></td>
                                @endif
                            </tr>
                        @endforeach
  </tbody>
</table>
</div>
</div>
</div>
</div>
<!-- <div class="mt-3 widget widget-stats bg-primary"><div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div><div class="stats-content"><div class="stats-title">TOTAL NUMBER OF PROJECTS</div><div class="stats-number">PROJECTS: {{number_format($stats->totalProjects(), 0, '.', ',' )}} </div><div class="stats-progress progress"><div class="progress-bar" style="width: 40.5%;"></div></div><div class="stats-desc">The total number of projects reflects the scope and scale of an organization's efforts towards its mission and goals</div></div></div> -->
<!-- 
<hr style="border-top: 3px solid black;">
<hr style="border-top: 3px solid black;"> -->
<!-- Events widgets -->

<div class="row mt-3">
<div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-money"></i></div><div class="stats-info"><h3>All Donations Acquired</h3><p>P {{ number_format($stats->totalDonations(), 0, '.', ',') }}</p></div><div class="stats-link"><a href="/donations">View Details</a></div></div></div>
<div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-credit-card"></i></div><div class="stats-info"><h3>Total Event Expense</h3><p>P {{ number_format($stats->totalExpenses(), 0, '.', ',') }}</p></div><div class="stats-link"><a href="/expenses">View Details </a></div></div></div>

<!-- <div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-warning"><div class="stats-icon"><i class="fa fa-clock"></i></div><div class="stats-info"><h3>All Archived Donations</h3><p>P {{ number_format($stats->totalArchivedDonations(), 0, '.', ',') }}</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div> -->

<div class="col-lg-6 col-sm-6 mx-auto">
<div class="card ">
  <div class="card-body">

  <table class="table table-bordered" id="myTable">
                        <thead class="bg-primary" style="color: white;" >
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Donor Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->event ? $donation->event->event_name : 'No event' }}</td>
                                    <td>{{ $donation->donor_name}}</td>
                                    <td>₱ {{ number_format($donation->amount, 0, '.', ',' ) }}</td>
                                </tr>
                               
                               @endforeach
                        </tbody>
                    </table>


</div>
</div>
</div> 

<div class="col-lg-6 col-sm-6 mx-auto">
<div class="card ">
  
  <div class="card-body">
  <table class="table table-bordered" id="myTable">
                        <thead  class="bg-primary" style="color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Expense Name</th>
                               
                     
                          
                            
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->event ? $expense->event->event_name : '' }}</td>
                                <td>{{ $expense->expense_name }}</td>
                                <td>₱ {{ number_format($expense->amount, 0, '.', ',' ) }}</td>
                             
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
</div>
</div> 
</div>  

<!-- Events widgets -->

 <!-- Users Design
 <h1 class="mt-3 mb-3"><span class="badge badge-primary">Users Data</span></h1>
 <div class="row">
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-desktop"></i></div><div class="stats-info"><h3>TOTAL VISITORS</h3><p>3,291,922</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div>
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-desktop"></i></div><div class="stats-info"><h3>TOTAL VISITORS</h3><p>3,291,922</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div>
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-desktop"></i></div><div class="stats-info"><h3>TOTAL VISITORS</h3><p>3,291,922</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div>
<div class="col-lg-3 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-desktop"></i></div><div class="stats-info"><h3>TOTAL VISITORS</h3><p>3,291,922</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div>
</div>
<div class="row">
<div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-desktop"></i></div><div class="stats-info"><h3>TOTAL VISITORS</h3><p>3,291,922</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div>
<div class="col-lg-6 col-sm-6"><div class="widget widget-stats bg-primary"><div class="stats-icon"><i class="fa fa-desktop"></i></div><div class="stats-info"><h3>TOTAL VISITORS</h3><p>3,291,922</p></div><div class="stats-link"><a href="javascript:;">View Details</a></div></div></div>
</div> -->



@endsection
