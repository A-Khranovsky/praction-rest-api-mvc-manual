<?php

namespace App\Config;

use App\Router\Route;

Route::get('tasks', null, 'index');
Route::get('auth', null, 'index');
Route::get('tasks', 'create', 'create');
Route::get('tasks', 'edit', 'edit');

Route::post('tasks', null, 'store');
Route::patch('tasks', null, 'update');
Route::delete('tasks', null, 'destroy');
