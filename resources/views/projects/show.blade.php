@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
			<div class="card-header"style="background-color: #2580ff; color:white;"><b>{{ __('View Information') }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<form>
						<!-- 2 column grid layout with text inputs for the first and last names -->
						<div class="row mb-4">
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example1">Project id</label>
							<input disabled type="text" id="form6Example1" class="form-control" value="{{ $project->id }}" />
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">Project Name</label>
								<input disabled type="text" id="form6Example2" class="form-control" value="{{ $project->project_name }}" />
								
							</div>
							</div>
						</div>
						<div class="form-outline mb-4">
							<label class="form-label" for="form6Example7">Commission Responsible</label>
							<input disabled type="text" id="form6Example2" class="form-control" value="{{ $project->commission }}" />
						</div>
						<div class="form-outline mb-4">
							<label class="form-label" for="form6Example7">Description</label>
							<textarea disabled class="form-control" id="form6Example7" rows="4"  > {{ $project->description}}</textarea>
						</div>
						@if($project->project_comments)
						<div class="form-outline mb-4">
							<label class="form-label" for="form6Example7">Cancellation justification</label>
							<textarea disabled class="form-control" id="form6Example7" rows="4"  > {{ $project->project_comments}}</textarea>
						</div>
						@endif
						<div class="row mb-4">
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example1">Status</label>
								<input disabled type="text" id="form6Example1" class="form-control"  value="{{ $project->status}}" />
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">Budget</label>
								<input disabled type="text" id="form6Example2" class="form-control" value="{{ $project->budget }}" />
								
							</div>
							</div>
						</div>

						<div class="row mb-4">
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example1">Start Date</label>
								<input disabled type="text" id="form6Example1" class="form-control"  value="{{ $project->date->toFormattedDateString()}}" />
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">End Date</label>
								<input disabled  type="text" id="form6Example2" class="form-control" value="{{ date('M j, Y', strtotime($project->projectTargetDeadline ))}}" />  
								
							</div>
							</div>
						</div>
						<br>
						<br>
						<br>
						<div class="row mb-4">
							<div class="col">
								<div class="form-outline">
								<div class="row mb-4">
							<div class="col-1">
								<div class="form-outline">
								<label class="form-label" for="form6Example1">ID</label>
								<input disabled type="text" id="form6Example1" class="form-control" value="{{$project->user_id }}" >
								</div>
							</div>
							<div class="col-11">
								<div class="form-outline">
								<label class="form-label" for="form6Example2">Created by</label>
								<input disabled type="text" id="form6Example2" class="form-control"  value="{{ $project->project_createdby }}"/>
								</div>
							</div>
							</div>

							<div class="row mb-4">
							@if ($project->status != 'Pending')
								<div class="col-1">
								<div class="form-outline">
									<label class="form-label" for="form6Example3">ID</label>
									<input disabled type="text" id="form6Example3" class="form-control" value="{{$project->approver_id }}" >
								</div>
								</div>
								<div class="col-11">
								<div class="form-outline">
									<label class="form-label" for="form6Example4">
									@if ($project->status == 'Cancelled')
										{{ __('Rejected by') }}
									@elseif($project->status == 'Approved')
										{{ __('Approved by') }}
										@elseif($project->status == 'Archived')
										{{ __('Archived by') }}
									@endif
									</label>
									<input disabled type="text" id="form6Example4" class="form-control" value="{{ $project->project_approvedby }}" />
								</div>
								</div>
							@endif
							</div>

					
						
						
						<button type="button" class="btn btn-primary" onclick="cancelForm()">Back</button>
						</form>
										
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cancelForm() {
        window.location.href = '/projects';
        event.preventDefault();
    }
    </script>

@endsection