<!-- Modal -->


<div class="modal fade" id="disable_user_{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <div class="modal-content">
    <div class="modal-header" style="background-color: #2580ff; color: white;">
      <h6 class="modal-title" id="exampleModalLabel">Are you sure you want to change the user status?</h6x    >
      <button type="button" class="close" data-dismiss="modal" style="color: white"aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <form method="POST" action="/ppcs/{{ $id }}/{{ $ppc->disabled ? 'enable' : 'disable' }}" style="display: inline-block;">
        @csrf
        {{ method_field('PATCH') }}
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <div class="modal-body">
            <div class="form-group">
              <label>Please enter your admin password: </label>
              <input type="password" name="admin_password" class="form-control @error('admin_password') is-invalid @enderror">
              @error('admin_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
           
            <button type="submit" class="btn btn-{{ $ppc->disabled ? 'success' : 'danger' }}">
              {{ $ppc->disabled ? 'Enable User' : 'Disable User' }}
            </button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
$('#disable_user_{{ $id }} form').on('submit', function(event) {
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
        $('#disable_user_{{ $id }}').modal('hide');
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