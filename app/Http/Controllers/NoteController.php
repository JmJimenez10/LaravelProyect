<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Middleware para verificar la autenticación del usuario en todas las acciones del controlador.
    }

    // Método para mostrar todas las notas del usuario autenticado.
    public function index()
    {
        if (Auth::check()) { // Verifica si el usuario está autenticado.
            $userId = Auth::id(); // Obtiene el ID del usuario autenticado.

            // Obtiene todas las notas del usuario con sus usuarios compartidos relacionados.
            $notes = Note::with('sharedUsers')->where('user_id', $userId)->get();

            return view('note.index', ['notes' => $notes]); // Retorna la vista con las notas obtenidas.
        } else {
            return redirect()->route('login'); // Redirecciona al usuario a la página de inicio de sesión si no está autenticado.
        }
    }

    // Método para almacenar una nueva nota.
    public function store(Request $request)
    {
        // Crea una nueva nota y asigna los valores recibidos del formulario.
        $notes = new Note;
        $notes->title = $request->input('title');
        $notes->content = $request->input('content');
        $notes->user_id = $request->input('id_user');
        $notes->state = 'pending';
        $notes->owner_name = $request->input('owner_name');
        $notes->save(); // Guarda la nueva nota en la base de datos.

        return redirect()->back(); // Redirecciona de vuelta al usuario a la página anterior.
    }

    // Método para actualizar una nota existente.
    public function update(Request $request, $id)
    {
        $notes = Note::find($id); // Busca la nota por su ID.
        $notes->title = $request->input('title'); // Actualiza el título de la nota.
        $notes->content = $request->input('content'); // Actualiza el contenido de la nota.
        $notes->update(); // Actualiza la nota en la base de datos.
        return redirect()->back(); // Redirecciona de vuelta al usuario a la página anterior.
    }

    // Método para eliminar una nota.
    public function destroy($id)
    {
        $notes = Note::find($id); // Busca la nota por su ID.
        $notes->delete(); // Elimina la nota de la base de datos.
        return redirect()->back(); // Redirecciona de vuelta al usuario a la página anterior.
    }

    // Método para actualizar el estado de una nota.
    public function updateState(Request $request)
    {
        $noteId = $request->input('id'); // Obtiene el ID de la nota.
        $state = $request->input('state'); // Obtiene el nuevo estado de la nota.

        $note = Note::find($noteId); // Busca la nota por su ID.
        if ($note) {
            $note->state = $state; // Actualiza el estado de la nota.
            $note->save(); // Guarda los cambios en la base de datos.
        }
    }

    // Método para compartir una nota con otro usuario.
    public function shareNote(Request $request, $noteId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validación de los datos recibidos del formulario.
        ]);

        $user = User::find($request->user_id); // Busca al usuario por su ID.
        $note = Note::find($noteId); // Busca la nota por su ID.

        $note->user()->attach($user->id); // Asocia la nota con el usuario especificado.

        return redirect()->back(); // Redirecciona de vuelta al usuario a la página anterior.
    }

    // Método para eliminar la compartición de una nota con un usuario.
    public function deleteShare(Note $note, User $user)
    {
        if ($note->user()->where('user_id', $user->id)->exists()) { // Verifica si la nota está compartida con el usuario especificado.
            $note->user()->detach($user->id); // Elimina la compartición de la nota con el usuario.

            return redirect()->back(); // Redirecciona de vuelta al usuario.
        } else {
            return redirect()->back(); // Redirecciona de vuelta al usuario.
        }
    }
}
