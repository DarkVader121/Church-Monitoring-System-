<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="modal fade" id="CreatePfcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background-color: #2580ff; color: white;">
      <h5 class="modal-title" id="exampleModalLabel">Add PFC</h5>
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body"> 
                <form method="POST" action="/pfc">
                    @csrf
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h6>Please fill in the form below.</h6>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                               <label>First Name</label>
                           <div class="clearable-input">
                              <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                           
                          </div>
                         @error('first_name"')
                     <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                         </span>
                      @enderror
                      </div>

                        <div class="col form-group">
                              <label>Last Name</label>
                              <div class="clearable-input">
                              <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                              
                              </div> 
                              @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                          </div>
                        
                        <div class="form-group ">
                          <label>Address</label>
                          <div class="clearable-input">
                          <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" >
                          
                          </div>   
                          @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                      
                      <div class="form-row">
                       <div class="form-group col-md-6">
                          <label>Contact No.</label>
                          <div class="clearable-input">
                          <div class="input-group">
                          <div class="input-group-prepend">
                        <span class="input-group-text">09</span>
                          </div>
                        <input type="text" id="contact_no" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror"  >
                              </div> 
                              </div>
                               @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <div class="col form-group">
                        <label>Birthday</label>
                        <div class="clearable-input">
                          <input type="date" id="age"name="birthday" class="form-control @error('birthday') is-invalid @enderror" >
                          </div>
                          @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        </div>  
                        <div class="form-group ">
                          <label>Username</label>
                          <div class="clearable-input">
                          <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" >
                          
                          </div>
                         @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  

                        <div class="form-group ">
                         <label>Password</label>
                                 <input type="password" name="password" class="form-control @error('password') is-invalid @enderror confirmed">
                                  @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                              @enderror
                                </div>

                                <div class="form-group ">
                         <label>Confirm Password<small class="form-text text-muted">Please enter the password again to confirm.</small></label>
                         <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror confirmed">
                  @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                     <strong>Passwords does not match.</strong>
                           </span>
                        @enderror
                        </div> 
                        <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" onclick="cancelForm()" id="clear-button">Clear Form <i class="fa fa-times"></i> </button>
                        <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
    <br><div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {
  // add click event listener to clear button
  $('#clear-button').click(function() {
    // show SweetAlert confirmation message
    Swal.fire({
      text: "Are you sure you want to reset all fields?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, reset it!'
    }).then((result) => {
      if (result.isConfirmed) {
        // reset form fields
        $('#CreatePfcModal form')[0].reset();
        // close any SweetAlert modals
        Swal.close();
      }
    })
  });
});


$('#CreatePfcModal form').on('submit', function(event) {
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
            $('#CreatePfcModal').modal('hide');
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


      
