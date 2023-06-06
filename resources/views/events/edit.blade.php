@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"style="background-color: #2580ff; color:white;">{{ __('Edit Event') }}</div>
                <form method="POST" action="/events/{{ $event->id }}">
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
                                <option value="{{ $projectId }}" {{ $event->project_id == $projectId ? 'selected' : '' }}>{{ $project }}</option>
                            @endforeach
                        </select>
                        @error('project')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                      <label>Event Name @error('event_name')<span class="text-danger"> *</span>@enderror</label>
                      <input type="text" name="event_name" class="form-control @error('event_name') is-invalid @enderror" value="{{ $event->event_name }}">
                        @error('event_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                <div class="form-group ">
                  <label>Description @error('description')<span class="text-danger"> *</span>@enderror</label>
                  <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror">{{ $event->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 

                <div class="form-group ">
                  <label>Event Type @error('event_type')<span class="text-danger"> *</span>@enderror</label>
                    <select class="form-control @error('event_type') is-invalid @enderror" name="event_type">
                        <option disabled="" selected="">Select Type</option>
                        <option value="Fiesta" {{ $event->event_type == 'Fiesta' ? 'selected' : '' }}>Fiesta</option>
                        <option value="Entertainment"  {{ $event->event_type == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                        <option value="Sports" {{ $event->event_type == 'Sports' ? 'selected' : '' }} >Sports</option>
                        <option value="Fund Raising" {{ $event->event_type == 'Fund Raising' ? 'selected' : '' }}>Fund Raising</option>
                    </select>
                    @error('event_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>   

                <div class="form-group ">
                  <label>Start Date @error('date')<span class="text-danger"> *</span>@enderror</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}">
                     @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group ">
                  <label>End Date @error('eventsTargetDeadline')<span class="text-danger"> *</span>@enderror</label>
                    <input type="date" name="eventsTargetDeadline" class="form-control @error('date') is-invalid @enderror" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}">
                     @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                  <label>Venue @error('venue')<span class="text-danger"> *</span>@enderror</label>
                    <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ $event->venue }}">
                     @error('venue')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-primary" onclick="cancelForm()">Cancel</button>
                <button type="submit" href= '/pending-events' class="btn btn-primary">Update</button>
                
                </div>
            </div>
        </div>
    </div> 

    <script>
    function cancelForm() {
        window.location.href = '/pending-events';
        event.preventDefault();
    }
    </script>


@endsection