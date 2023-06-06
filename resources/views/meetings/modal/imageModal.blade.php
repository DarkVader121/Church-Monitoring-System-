<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img src="{{ asset('storage/images/'.$meeting->attendance_image) }}" class="img-fluid">
      </div>
    </div>
  </div>
</div>