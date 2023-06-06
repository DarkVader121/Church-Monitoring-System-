@extends('layouts.app')

@section('content')


<div class="container">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('View Information') }}</b></div>
                <form method="POST" action="/meetings/{{ $meeting->id }}" id="chairman-form">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-row">
                        <div class="form-group col-md-6">
                              <label>Project</label>
                              <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" style="color: black;"disabled value="{{ $meeting->project ? $meeting->project->project_name : ' '}}">
                               
                        </div>

                        <div class="form-group col-md-6">
                              <label>Meeting Sponsor</label>
                              <input type="text" class="form-control" style="color: black;"disabled value="{{ $meeting->meeting_sponsor}}">
                              
                        </div>

                        <div class="col">
                              <label>Meeting Name</label>
                              <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"  style="color: black;"disabled value="{{ $meeting->meeting_name }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    
                        </div>
                        <div class="form-group ">
                          <label>Description</label>
                          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"style="color: black;" disabled value="{{ $meeting->description }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                          <label>Agenda</label>
                          <input type="text" name="Agenda" class="form-control @error('address') is-invalid @enderror"style="color: black;" disabled value="{{ $meeting->agenda }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Date</label>
							<input type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" style="color: black;" disabled value="{{ date('Y-m-d', strtotime($meeting->date_time)) }}">
                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     
                        <div class="col">
                          <label>Time</label>
                          <input type="text" name="age" class="form-control @error('age') is-invalid @enderror"style="color: black;" disabled value="{{ date('g:i a', strtotime($meeting->date_time)) }}">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>    

                        <div class="form-group ">
                          <label>Venue</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" style="color: black;"disabled value="{{ $meeting->venue }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  

                        <div class="row mb-4">
							<div class="col">
								<div class="form-outline">
								<div class="row mb-4">
							<div class="col-1">
								<div class="form-outline">
								<label class="form-label" for="form6Example1">ID</label>
								<input disabled type="text" id="form6Example1" class="form-control" value="{{$meeting->creator_id}}" >
								</div>
							</div>
							<div class="col-11">
								<div class="form-outline">
								<label class="form-label">Created by</label>
								<input disabled type="text" id="form6Example2" class="form-control"  value="{{ $meeting->creator_name }}"/>
								</div>
							</div>
							</div>

							<div class="row mb-4">
							@if ($meeting->status != 'Pending')
								<div class="col-1">
								<div class="form-outline">
									<label class="form-label" for="form6Example3">ID</label>
									<input disabled type="text" id="form6Example3" class="form-control" value="{{$meeting->decider_id }}" >
								</div>
								</div>
								<div class="col-11">
								<div class="form-outline">
									<label class="form-label" for="form6Example4">
									@if ($meeting->status == 'Cancelled')
										{{ __('Rejected by') }}
									@elseif($meeting->status == 'Approved')
										{{ __('Approved by') }}
	
									@endif
									</label>
									<input disabled type="text" id="form6Example4" class="form-control" value="{{ $meeting->decider_name }}" />
								</div>
								</div>
							@endif

                            @if ($meeting->status == 'Archived')
                            <div class="col-1">
								<div class="form-outline">
									<label class="form-label" for="form6Example3">ID</label>
									<input disabled type="text" id="form6Example3" class="form-control" value="{{$meeting->archiver_id }}" >
								</div>
								</div>
								<div class="col-11">
								<div class="form-outline">
									<label class="form-label" for="form6Example4">
									Archived by
									</label>
									<input disabled type="text" id="form6Example4" class="form-control" value="{{ $meeting->decider_name }}" />
								</div>
								</div>
                            @endif
							</div>
						<div class="row">
                            <!-- col -->
                            <div class="col-md-4">
                                        <label>Current Minutes</label>
                                        <a data-toggle="modal" data-target="#image">
                                                    <img src="{{ asset('storage/minutes/'.$meeting->minutes)}}"
                                                    width='500'  
                                                    Height="500px"
                                                        class="img img-responsive"
                                                        />
										</a>
										@include ('meetings.modal.image')
                            </div>
                             <!-- col -->
                            <div class="col-md-4">
                                    <label>Previous Minutes</label>
                                    <a data-toggle="modal" data-target="#prevMeeting">
                                                <img src="{{ asset('storage/previous_minutes/'.$meeting->previous_meeting) }}" 
                                                width='500'  
                                                Height="500px"
                                                class="img img-responsive" 
                                                />
									</a>
									@include ('meetings.modal.previousMeeting')
                            </div>
                             <!-- col -->
                             <div class="col-md-4">
                                    <label>Attendance Image</label>
                                    <a data-toggle="modal" data-target="#imageModal">
                                                <img src="{{ asset('storage/images/'.$meeting->attendance_image) }}" 
                                                width='500'  
                                                Height="500px"
                                                class="img img-responsive" 
                                                />
                                            </a>
									@include ('meetings.modal.imageModal')
                            </div>

                        </div>
						
                        <div class="form-group" class="flex">
                        <button class="btn btn-primary" type="button" onclick="cancelForm()"><i class="fa fa-arrow-left"></i> Back</button>

                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function cancelForm() {
        history.back();
    }
    </script>

@endsection