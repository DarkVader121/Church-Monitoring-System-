<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
    <div class="modal-header"  style="background-color: #2580ff; color: white;">
    <div class="col mx-3">
      <h5 class="modal-title" id="exampleModalLabel"> <b>CREATE EXPENSE </b> </h5>
      <small style="color:white; align-self-end;" >It is important to filter the event before creating an expense.
      </div> 
     </small>
   
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>


    </div>
      <div class="modal-body">
        <form method="POST" action="/expenses" >
                            @csrf
                         
                            <div id="total-donation-card" class="form-group card text-center">
                                <div class="card-header" style="background-color: #2580ff; color: white;">
                                  <h5>Sum of All Donations Subtracted from <i> {{$selectedEvent}} </i> Cost  </h5>
                                </div>
                                <div class="card-body">
                                <p class="card-text">The total amount of donations received by the Lila Holy Rosary Parish, net of expenses, is: ₱{{ number_format($totalDonation - $totalExpense, 0, '.', ',') }}</p>
                                </div>
                            </div>
                            <label >Event   &nbsp;  </label><small class="text-primary">Please select event before creating expense</small>
                            <div class="form-group">
                                
                                <select class="form-control" name="event">
                                @foreach ($events as $eventId => $event)
                                    <option value="{{ $eventId }}">{{ $event }}</option>
                                @endforeach
                            </select> 
                       
                  
                                @error('event')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="form-group ">
                        <label>Expense Name</label>
                        <input type="text" name="expense_name" class="form-control @error('expense_name') is-invalid @enderror">
                            @error('expense_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>   

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" style="width: 100%; height: 150px;"></textarea>
                        @error('description')
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
                      <label>Reference ID</label>
                      <input type="text" name="reference_id" class="form-control @error('reference id') is-invalid @enderror">
                        @error('Reference id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  

                    <div class="form-group ">
                      <label>Amount</label>
                      <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror">
                        @error('Amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                      
                    
                    <!-- <button id="add-input" type="button" class="btn btn-outline-success btn-sm btn-block mb-2">Add Item</button>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">1</span>
                                </div>
                            <input type="text" class="form-control" name="item_name[]" placeholder="Expense Name">
                                @error('item_name.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            <input type="text" class="form-control" name="amount_item[]" placeholder="Amount">
                                @error('amount_item.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        <button type="button" class="btn btn-outline-danger btn-sm btn-remove-item">X</button>
                    </div>
                    <div id="input-container"></div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
      </div>
      
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
$('#exampleModalCenter form').on('submit', function(event) {
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
            $('#exampleModalCenter').modal('hide');
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

