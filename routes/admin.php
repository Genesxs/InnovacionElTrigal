<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IdeasController;
use App\Http\Controllers\Admin\ParticipantesController;

Route::get('', [HomeController::class,'index'] )->name('admin.home');

Route::resource('ideas', IdeasController::class )->names('admin.ideas');

//ruta para insersion de tablas intermedias de ideas y usuarios
Route::put('participante/{idea}',[IdeasController::class,'createParticipante'])->name('admin.ideas.participante');

Route::get('participantes/{id}/show', [IdeasController::class,'show'] )->name('admin.show.participantes');

Route::get('idea/{id}', [IdeasController::class,'showIdea'] )->name('admin.show.idea');







