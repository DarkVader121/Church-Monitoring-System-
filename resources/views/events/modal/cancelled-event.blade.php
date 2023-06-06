
<!-- Modal to confirm rejection -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        

            <div class="modal-header" style="background-color: #2580ff; color: white;">
      <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to reject this event?</h5>
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
            <div class="modal-body">
                <p>Enter a reason for rejecting the event:</p>
                <textarea name="description" id="description" style="width: 100%;"rows="4" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="/events/{{ $event->id }}/cancelled" id="rejectForm">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="description" id="description_input" >
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Script to submit the form via Ajax when the modal's Reject button is clicked -->

<script>
    $(document).ready(function() {
        $('#rejectModal').on('shown.bs.modal', function() {
            $('#rejectForm').submit(function(e) {
                e.preventDefault();
                var description = $('#description').val();
                $('#description_input').val(description);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle the success response here
                        console.log(response);
                        $('#rejectModal').modal('hide'); // Hide the modal after success
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle the error response here
                        console.log(jqXHR.responseText);
                    }
                });
            });
        });
    });
</script>



