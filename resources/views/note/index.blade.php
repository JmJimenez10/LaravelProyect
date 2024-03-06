@extends('home')

@section('content')
    <div class="mt-5 pt-3"></div>
    <h2 class="text-center mt-5 pt-5">Notas de <span class="fw-bold">
            @if (Auth::check())
                <!-- Verifica si el usuario está autenticado -->
                {{ Auth::user()->name }}
            @endif

        </span></h2>
    <p class="text-center mb-3 fs-5">ID &nbsp;<i class="fs-5 fa-solid fa-arrow-right"></i>&nbsp; {{ Auth::user()->id }}</p>

    <div class="row container d-flex justify-content-evenly">
        @if ($notes->isEmpty())
            <!-- Verifica si el usuario no tiene notas -->
            <p class="text-center fs-2 fst-italic">Aún no tienes notas</p>
        @else
            @foreach ($notes as $note)
                @php
                    $title = strlen($note->title) > 15 ? substr($note->title, 0, 15) . '...' : $note->title;
                @endphp
                <div class="card col-5 my-2" style="width: 21rem;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex ">
                            @if ($note->state == 'pending')
                                <input class="form-check-input me-3" type="checkbox"
                                    id="checkboxNoLabel_{{ $note->id }}" value="{{ $note->id }}">
                            @else
                                <input class="form-check-input me-3" type="checkbox"
                                    id="checkboxNoLabel_{{ $note->id }}" checked value="{{ $note->id }}">
                            @endif
                            <h5 class="card-title">{{ $title }}</h5>
                        </div>

                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modal{{ $note->id }}">Ver</button>
                    </div>
                </div>

                <!-- Modal para cada nota -->
                <div class="modal fade" id="modal{{ $note->id }}" tabindex="-1"
                    aria-labelledby="modal{{ $note->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal{{ $note->id }}Label">Detalles de la nota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="">Título</h5>
                                <p class="mb-4">{{ $note->title }}</p>
                                <h5 class="">Contenido</h5>
                                <p class="mb-4">{!! nl2br(e($note->content)) !!}</p>
                                <h5 class="">Fecha de creación</h5>
                                <p class="mb-4">{{ $note->created_at }}</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="index" value="{{ $note->id }}">
                                <button type="button" class="btn btn-info my-3" data-bs-toggle="modal"
                                    data-bs-target="#share{{ $note->id }}"><i
                                        class="fs-6 fa-solid fa-share-from-square"></i>&nbsp;Compartir</button>
                                <button type="button" class="btn btn-warning my-3" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $note->id }}"><i
                                        class="fs-6 fa-solid fa-pen-to-square"></i>&nbsp;Modificar</button>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" name="eliminar"><i
                                            class="fs-6 fa-solid fa-trash"></i>&nbsp;Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('note.info') <!-- Incluye la plantilla para mostrar información adicional de la nota -->
            @endforeach
        @endif
    </div>

    {{-- Sección para mostrar notas compartidas contigo --}}
    <div class="mt-5 pt-3"></div>
    <h2 class="text-center mt-5 pt-5 mb-3">Notas compartidas contigo</h2>
    <div class="row container d-flex justify-content-evenly">
        @if (Auth::user()->sharedNotes()->exists())
            <!-- Verifica si hay notas compartidas con el usuario autenticado -->
            @foreach (Auth::user()->sharedNotes as $sharedNote)
                <div class="card col-5 my-2" style="width: 21rem;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <h5 class="card-title">{{ $sharedNote->title }}</h5>
                        </div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modal{{ $sharedNote->id }}">Ver</button>
                    </div>
                </div>

                <!-- Modal para cada nota -->
                <div class="modal fade" id="modal{{ $sharedNote->id }}" tabindex="-1"
                    aria-labelledby="modal{{ $sharedNote->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal{{ $sharedNote->id }}Label">Detalles de la nota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="">Propietario <span class="fw-bold">{{ $sharedNote->owner_name }}</span>
                                </h5>
                                <h5 class="">Título</h5>
                                <p class="mb-4">{{ $sharedNote->title }}</p>
                                <h5 class="">Contenido</h5>
                                <p class="mb-4">{!! nl2br(e($sharedNote->content)) !!}</p>
                                <h5 class="">Fecha de creación</h5>
                                <p class="mb-4">{{ $sharedNote->created_at }}</p>
                            </div>
                            <div class="modal-footer">
                                <form
                                    action="{{ route('notes.shared.delete', ['note' => $sharedNote->id, 'user' => Auth::user()->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" name="eliminar"><i
                                            class="fs-6 fa-solid fa-trash"></i>&nbsp;Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('note.info') <!-- Incluye la plantilla para mostrar información adicional de la nota -->
            @endforeach
        @else
            <p class="text-center fs-2 fst-italic">No tienes notas compartidas contigo.</p>
        @endif
    </div>

    @include('note.create') <!-- Incluye la plantilla para crear una nueva nota -->
@endsection
