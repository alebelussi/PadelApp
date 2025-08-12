<!-- MODALE PER AVVISARE DELLA RIMOZIONE -->
@props(['id', 'name', 'route'])
<div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rimozione in corso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <p>Attenzione: stai per eliminare il {{$name}}!</p>
      </div>
      <div class="modal-footer">
        <form action="{{ $route }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE') <!-- SIMULA LA RIMOZIONE -->
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
      </div>
    </div>
  </div>
</div>