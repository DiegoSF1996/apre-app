<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::apiResource('assuntos', App\Http\Controllers\Estudo\AssuntoController::class)->parameters(['assuntos' => 'id']);

Route::apiResource('questaos', App\Http\Controllers\Estudo\QuestaoController::class)->parameters(['questaos' => 'id']);

Route::apiResource('respostas', App\Http\Controllers\Estudo\RespostaController::class)->parameters(['respostas' => 'id']);

Route::apiResource('respostausers', App\Http\Controllers\estudo\RespostaUserController::class)->parameters(['respostausers' => 'id']);
