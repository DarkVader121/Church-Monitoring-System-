<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background-color: #2580ff; color: white;">
      <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
        
                <form method="POST" action="/events">
                    @csrf
                    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif  

                    <div class="form-group">
                        <label>Project</label>
                        <select class="form-control  @error('project') is-invalid @enderror" name="project">
                           <option disabled="" selected="" value="Select Project" >Select Project</option>
                            @foreach ($projects as $projectId => $project)
                                <option value="{{ $projectId }}">{{ $project }}</option>
                            @endforeach
                        </select>
                        @error('project')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                      <label>Event Name</label>
                      <input type="text" name="event_name" class="form-control @error('event_name') is-invalid @enderror">
                        @error('event_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                <div class="form-group ">
                  <label>Description</label>
                  <textarea type="text" name="description" rows="6" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 

                <div class="form-group ">
                  <label>Event Type</label>
                    <select class="form-control @error('event_type') is-invalid @enderror" name="event_type">
                        <option disabled="" selected="">Select Type</option>
                        <option value="Fiesta">Fiesta</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Sports">Sports</option>
                        <option value="Fund Raising">Fund Raising</option>
                    </select>
                    @error('event_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>   

                <div class="form-group ">
                  <label>Start Date</label>
                    <input type="date" name="date"  max="<?php echo date("Y-m-d"); ?>" id="datetimepicker1"class="form-control @error('date') is-invalid @enderror">
                     @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group ">
                  <label>End Date</label>
                    <input type="date" name="eventsTargetDeadline" class="form-control @error('date') is-invalid @enderror">
                     @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                  <label>Venue</label>
                    <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror">
                     @error('venue')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
                </div>
            </div>
        </div>
    </div> 
                   
    <br><div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#exampleModal form').on('submit', function(event) {
    event.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var data = form.serialize();

    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(response) {
           
            form.find('.text-danger').removeClass('text-danger');
            form.find('.invalid-feedback').remove();
            form.find('.is-invalid').removeClass('is-invalid');
            $('#exampleModal').modal('hide');
            location.reload();
        },
        error: function(xhr) {
            event.preventDefault();
            var errors = xhr.responseJSON.errors;
            // handle validation errors
            form.find('.invalid-feedback').remove();
            form.find('.is-invalid').removeClass('is-invalid');
            $.each(errors, function(field, messages) {
                var input = form.find('[name="' + field + '"]');
                input.addClass('is-invalid');
                var label = input.closest('.form-group').find('label');
                label.addClass('text-danger');
                if (!label.find('.asterisk').length) {
                    label.append('<span class="asterisk">*</span>');
                }
                $.each(messages, function(index, message) {
                    input.after('<span class="invalid-feedback" role="alert">' + message + '</span>');
                });
            });
            // remove asterisk and red text when there is no validation error
            form.find('.form-group').each(function() {
                var label = $(this).find('label');
                if (!$(this).find('.is-invalid').length) {
                    label.removeClass('text-danger');
                    label.find('.asterisk').remove();
                }
            });
        }

    });
});
      
</script>



