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
							<label class="form-label" for="form6Example1">Event id</label>
							<input  disabled type="text" id="form6Example1" class="form-control" value="{{ $event->id }}" />
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">Event Name</label>
								<input disabled type="text" id="form6Example2" class="form-control" value="{{ $event->event_name }}" />
								
							</div>
							</div>
						</div>
						<div class="form-outline mb-4">
							<label class="form-label" for="form6Example7">Description</label>
							<textarea disabled class="form-control" id="form6Example7" rows="4"  > {{ $event->description}}</textarea>
						</div>

						@if($event->events_comments)
						<div class="form-outline mb-4">
							<label class="form-label" for="form6Example7">Cancel Reason</label>
							<textarea disabled class="form-control" id="form6Example7" rows="4"  > {{ $event->events_comments}}</textarea>
						</div>
						@endif
						<div class="row mb-4">
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">Linked Project Name</label>
								<input disabled type="text" id="form6Example2" class="form-control" value="{{ $event->project ? $event->project->project_name : '' }}"/>
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example1">Status</label>
								<input disabled type="text" id="form6Example1" class="form-control"  value="{{ $event->status}}" />
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">Event Type</label>
								<input disabled type="text" id="form6Example2" class="form-control" value="{{ $event->event_type }}"/>
								
							</div>
							</div>
						</div>

						<div class="row mb-4">
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example1">Start Date</label>
								<input disabled type="text" id="form6Example1" class="form-control"  value="{{ $event->date->toFormattedDateString()}}" />
								
							</div>
							</div>
							<div class="col">
							<div class="form-outline">
							<label class="form-label" for="form6Example2">End Date</label>
								<input disabled  type="text" id="form6Example2" class="form-control" value="{{ date('M j, Y', strtotime( $event->eventsTargetDeadline)) }}" />
								
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
								<input disabled type="text" id="form6Example1" class="form-control" value="{{$event->creator_id}}" >
								</div>
							</div>
							<div class="col-11">
								<div class="form-outline">
								<label class="form-label" for="form6Example2">Created by</label>
								<input disabled type="text" id="form6Example2" class="form-control"  value="{{ $event->events_createdby }}"/>
								</div>
							</div>
							</div>

							<div class="row mb-4">
							@if ($event->status != 'Pending')
								<div class="col-1">
								<div class="form-outline">
									<label class="form-label" for="form6Example3">ID</label>
									<input disabled type="text" id="form6Example3" class="form-control" value="{{$event->approver_id }}" >
								</div>
								</div>
								<div class="col-11">
								<div class="form-outline">
									<label class="form-label" for="form6Example4">
									@if ($event->status == 'Cancelled')
										{{ __('Rejected by') }}
									@elseif($event->status == 'Approved')
										{{ __('Approved by') }}
										@elseif($event->status == 'Archived')
										{{ __('Archived	 by') }}
									@endif
									</label>
									<input disabled type="text" id="form6Example4" class="form-control" value="{{ $event->events_approvedby }}" />
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
        history.back();
        event.preventDefault();
    }
    </script>

@endsection