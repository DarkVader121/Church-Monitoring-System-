@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"  style="background-color: #2580ff; color: white;">{{ __('Edit Meeting') }}</div>
                <form method="POST" action="/meetings/{{ $meeting->id }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Project </label>
                            <select class="form-control  @error('project') is-invalid @enderror" name="project">
                               <option disabled="" selected="" value="Select Project" >Select Project</option>
                                @foreach ($projects as $projectId => $project)
                                    <option value="{{ $projectId }}"{{ $meeting->project_id == $projectId ? 'selected' : '' }}>{{ $project }}</option>
                                @endforeach
                            </select>
                            @error('project')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                       <div class="form-group ">
                          <label>Meeting Name @error('meeting_name')<span class="text-danger"> *</span>@enderror</label>
                          <input type="text" name="meeting_name" class="form-control @error('meeting_name') is-invalid @enderror" value="{{ $meeting->meeting_name }}">
                            @error('meeting_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                          <label>Description @error('description')<span class="text-danger"> *</span>@enderror</label>
                          <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $meeting->description }}">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                          <label>Agenda @error('Agenda')<span class="text-danger"> *</span>@enderror</label>
                          <input type="text" name="agenda" class="form-control @error('agenda') is-invalid @enderror" value="{{ $meeting->agenda }}">
                            @error('agenda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                              <label>Date Time @error('date_time')<span class="text-danger"> *</span>@enderror</label> 
                              <input type='datetime-local' class="form-control @error('date_time') is-invalid @enderror" name="date_time" id='datetimepicker1' value="{{ $meeting->date_time ? date('Y-m-d\TH:i', strtotime($meeting->date_time)) : '' }}" /> 
                                @error('date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group ">
                          <label>Venue @error('venue')<span class="text-danger"> *</span>@enderror</label> 
                            <input type='text' name="venue" class="form-control @error('venue') is-invalid @enderror" id='' value="{{ $meeting->venue }}" /> 
                            @error('venue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


<div class="row">
    <!-- col -->
    <div class="col-md-4">
    <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header" style="background-color: #2580ff; color:white;"> <b>Current Minutes </b>  @if ($meeting->minutes)
                                        <small >An image is already present</small>
                                        @endif
                                        </div>
                                    <div class="card-body" >
                                        <a data-toggle="modal" data-target="#image">
                                        <img src="{{ asset('storage/minutes/'.$meeting->minutes)}}"
                                            width='1000'  
                                            Height="500px"
                                            class="img img-responsive" 
                                            />
                                        </a>
                                        @include ('meetings.modal.image')
                                    </div>
                                    <div class="card-footer bg-transparent border-primary">
                                         <input type='file' name="minutes" class="form-control @error('minutes') is-invalid @enderror" id='' value="{{ $meeting->minutes }}" /> 
                                                            @error('minutes')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                    </div>
    </div>
     <!-- col -->
     <div class="col-md-4">
     <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header" style="background-color: #2580ff; color:white;"><label> <b> Previous Meeting</b> @error('previous_image')  <span class="text-danger"> *</span>@enderror
                                         </label> 
                                           @if ($meeting->previous_meeting)
                                        <small >An image is already present</small>
                                        @endif
                                        </div>
                                    <div class="card-body" >
                                        <a data-toggle="modal" data-target="#prevMeeting">
                                        @if($meeting->previous_meeting)
                                            <img src="{{ asset('storage/previous_minutes/'.$meeting->previous_meeting) }}"
                                                width='1000'  
                                                height="500px"
                                                class="img img-responsive" 
                                            />
                                        @endif
                                        </a>
                                        @include ('meetings.modal.previousMeeting')
                                    </div>
                                    <div class="card-footer bg-transparent border-primary">
                                         <input type='file' name="previous_minutes" class="form-control @error('previous_minutes') is-invalid @enderror" id='' value="{{ $meeting->previous_minutes }}" /> 
                                                            @error('minutes')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                    </div>
    </div>
    <!-- col -->
    <div class="col-md-4">
    <div class="card text-white y mb-4" style="max-width: 18rem;">
                            <div class="card-header" style="background-color: #2580ff; color:white;"> <b>Attendance Image </b> @error('attendance_image')<span class="text-danger"> *</span>@enderror
                            @if ($meeting->attendance_image)
                             <small >An image is already present</small>
                             @endif </div>
                            <div class="card-body">
                            <a data-toggle="modal" data-target="#imageModal">
                                        @if($meeting->attendance_image)
                                        <img src="{{ asset('storage/images/'.$meeting->attendance_image) }}" 
                                                width='1000'  
                                                height="500px"
                                                class="img img-responsive" 
                                            />
                                        @endif
                                        </a>
                                        @include ('meetings.modal.imageModal')
                            </div>
                            <div class="card-footer bg-transparent border-primary">
                        <input type='file' name="attendance_image" class="form-control @error('attendance_image') is-invalid @enderror" id='' value="{{ $meeting->attendance_image }}" />
                        @error('attendance_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
    </div>


</div>

<!-- working area -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary" onclick="cancelForm()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                   

    <script>
    function cancelForm() {
        window.location.href = '/pending-meetings';
        event.preventDefault();
    }
    </script>

@endsection


