@foreach ($notes as $note)
    <!-- Modal para editar una nota -->
    <div class="modal fade" id="edit{{ $note->id }}" tabindex="-1" aria-labelledby="edit{{ $note->id }}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal{{ $note->id }}Label">Modificar nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('notes.update', $note->id) }}" method="post">
                    @csrf
                    @method('PUT') <!-- Método PUT para la actualización -->
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" name="title" id="tituloInput"
                                placeholder="Titulo" value="{{ $note->title }}">
                            <label for="tituloInput">Título</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Contenido" name="content" id="floatingTextarea2" style="height: 300px">{{ $note->content }}</textarea>
                            <label for="floatingTextarea2">Contenido</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" name="save" class="btn btn-success" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal para compartir una nota -->
    <div class="modal fade" id="share{{ $note->id }}" tabindex="-1" aria-labelledby="share{{ $note->id }}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal{{ $note->id }}Label">Compartir nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('notes.share', ['note' => $note->id]) }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="user_id" id="user_id"
                                placeholder="ID de usuario">
                            <label for="user_id">ID de usuario</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" name="save" class="btn btn-info" value="Compartir">
                    </div>
                </form>
                <hr>
                <div class="modal-body p-5">
                    <h5>Usuarios con acceso a esta nota:</h5>
                    @if ($note->sharedUsers->isNotEmpty())
                        <!-- Verifica si hay usuarios con acceso a la nota -->
                        <ul>
                            @foreach ($note->sharedUsers as $sharedUser)
                                <li>
                                    <form
                                        action="{{ route('notes.shared.delete', ['note' => $note->id, 'user' => $sharedUser->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE') <!-- Método DELETE para eliminar el acceso -->
                                        Nombre &nbsp;<i
                                            class="fs-6 fa-solid fa-arrow-right"></i>&nbsp;{{ $sharedUser->name }}
                                        &nbsp;&nbsp;|&nbsp;&nbsp; ID &nbsp;<i
                                            class="fs-6 fa-solid fa-arrow-right"></i>&nbsp; {{ $sharedUser->id }}

                                        &nbsp;&nbsp;<button type="submit" class="btn btn-danger"><i
                                                class="fs-6 fa-solid fa-trash"></i></button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nadie tiene acceso a esta nota aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
