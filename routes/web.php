<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal que muestra la lista de notas
Route::get('/', [NoteController::class, 'index']);

// Rutas de recursos para gestionar las notas (crear, leer, actualizar y eliminar)
Route::resource('notes', NoteController::class);

// Ruta para actualizar el estado de una nota mediante una solicitud POST
Route::post('/update-note-state', [NoteController::class, 'updateState'])->name('update.note.state');

// Rutas de autenticación
Auth::routes();

// Ruta para compartir una nota con otro usuario
Route::post('/notes/{note}/share', [NoteController::class, 'shareNote'])->name('notes.share');

// Ruta para eliminar la compartición de una nota con un usuario específico
Route::delete('/notes/{note}/shared/{user}', [NoteController::class, 'deleteShare'])->name('notes.shared.delete');


