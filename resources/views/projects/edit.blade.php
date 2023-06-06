@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #2580ff; color:white;">{{ __('Edit Project') }}</div>
                <form method="POST" action="/projects/{{ $project->id }}">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group ">
                              <label>Project Name @error('project_name')<span class="text-danger"> *</span>@enderror</label>
                              <input type="text" name="project_name" class="form-control @error('project_name') is-invalid @enderror" value="{{ $project->project_name }}">
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                              <label>Description @error('description')<span class="text-danger"> *</span>@enderror</label>
                              <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror"> {{ $project->description }} </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                              <label>Date @error('date')<span class="text-danger"> *</span>@enderror</label>
                              <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"  value="{{ \Carbon\Carbon::parse($project->date)->format('Y-m-d') }}"> 
                               @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                              <label>Budget @error('budget')<span class="text-danger"> *</span>@enderror</label>
                              <input type="text" name="budget" class="form-control @error('budget') is-invalid @enderror" value="{{ $project->budget }}"> 
                               @error('budget')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                           <button class="btn btn-outline-primary" onclick="cancelForm()" >Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>

    
<script>
    function cancelForm() {
        window.location.href = '/pending-projects';
        event.preventDefault();
    }
    </script>

@endsection

