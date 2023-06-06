 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background-color: #2580ff; color: white;">
      <h5 class="modal-title" id="exampleModalLabel">Add Donation</h5>
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
     
                    <form method="POST" action="/donations">
                        @csrf

                     <div class="form-group">
                        <label>Project</label>
                        <select class="form-control  @error('event') is-invalid @enderror" name="project">
                           <option disabled="" selected="" value="Select Event" >Select Project</option>
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
                      <label>Donor Name</label>
                      <input type="text" name="donor_name" class="form-control @error('donor_name') is-invalid @enderror">
                        @error('donor_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    

                    <!-- <div class="form-group ">
                      <label>Last Name</label>
                      <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                        @error('donor_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>     -->

                    <div class="form-group ">
                      <label>Amount</label>
                      <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror">
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>     

                    <div class="form-group ">
                      <label>Date</label>
                      <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                   <div class="form-group ">
                      <label>Donation Type</label>
                        <select class="form-control @error('donation_type') is-invalid @enderror" name="donation_type">
                            <option disabled="" selected="">Donation Type</option>
                            <option value="Cash">Cash</option>
                            <option value="Check">Check </option>
                            <option value="Gcash">Gcash</option> 
                        </select>
                        @error('donation_type')
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

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