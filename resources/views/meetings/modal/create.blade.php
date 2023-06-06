
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background-color: #2580ff; color: white;">
      <h5 class="modal-title" id="exampleModalLabel">Add Meeting</h5>
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
 
      <form method="POST" action="/meetings" enctype="multipart/form-data">
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
                                <option value="" ></option>
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

                            <div class="form-group">
                                <label>Non Project Related Meeting</label>
                                <select class="form-control  @error('non-project') is-invalid @enderror" name="meeting_sponsor">
                
                                    <optgroup label="Select Meeting Sponsor">
                                    <option value="" ></option>
                                       <option value="WESFLY">WESFLY</option> 
                                       <option value="PPC">PPC</option>
                                       <option value="PFC">PFC</option>
                                 </optgroup>
                                </select>
                               
                                  
                                @error('project')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                           <div class="form-group ">
                              <label>Meeting Name</label>
                              <input type="text" name="meeting_name" class="form-control @error('meeting_name') is-invalid @enderror">
                                @error('meeting_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                              <label>Description</label>
                              <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                              <label>Agenda</label>
                              <textarea id="agenda" name="agenda" class="form-control @error('description') is-invalid @enderror" rows="5"></textarea>
                                @error('agenda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                              <label>Date Time</label> 
                                <input type='datetime-local' class="form-control @error('date_time') is-invalid @enderror" name="date_time"/> 
                                @error('date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                              <label>Venue</label> 
                                <input type='text' name="venue" class="form-control @error('venue') is-invalid @enderror" id='' /> 
                                @error('venue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                          <label>Minutes</label>     <small class="text-primary">Optional</small> <br>
                          <small> Current Minutes </small>
                            <input type='file' name="minutes" class="form-control @error('minutes') is-invalid @enderror"/> 
                            @error('minutes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group ">
                          <label>Attendance Image</label>  <small class="text-primary">Optional</small> <br>
                            <input type='file' name="attendance_image" class="form-control @error('attendance_image') is-invalid @enderror" id='' /> 
                            @error('attendance_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                   </div>
            </div>
        </div>
    </div>
                     
 
    <br><div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    var formData = new FormData(this); // create FormData object from form data

    $.ajax({
        url: url,
        type: method,
        data: formData, // use FormData object instead of serialized form data
        contentType: false, // set content type to false, so that jQuery does not try to set it
        processData: false, // set processData to false, so that jQuery does not try to process the data
        success: function(response) {
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
                $.each(messages, function(index, message) {
                    input.after('<span class="invalid-feedback" role="alert">' + message + '</span>');
                });
            });
        }
    });
});


</script>