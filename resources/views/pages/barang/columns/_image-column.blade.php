@if($model->foto)
    <a href="#" class="gambar-link" data-toggle="modal" data-target="#gambarModal" data-foto="{{ asset($model->foto) }}">
        Lihat
    </a>
@else
    <span class="text-muted">Tidak Ada Foto</span>
@endif

<!-- Modal -->
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gambarModalLabel">Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.gambar-link').on('click', function() {
            var foto = $(this).data('foto');
            $('#modalImage').attr('src', foto);
        });
    });
</script>
