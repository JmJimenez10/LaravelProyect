<!-- Modal para crear una nueva nota -->
<div class="modal fade" id="newNote" tabindex="-1" aria-labelledby="newNote" aria-hidden="true" data-bs-backdrop="static"
    data-bs-show="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newNoteTitle">Nueva Nota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('notes.store') }}" method="post">
                <!-- Formulario para enviar los datos de la nueva nota -->
                @csrf
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input required type="text" class="form-control" name="title" id="tituloInput"
                            placeholder="Titulo">
                        <label for="tituloInput">Título</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Contenido" name="content" id="floatingTextarea2" style="height: 300px"></textarea>
                        <label for="floatingTextarea2">Contenido</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="owner_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="submit" name="save" class="btn btn-success" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
