<?php

use Illuminate\Support\Facades\Route;
use Lightit\Shared\App\Exceptions\InvalidActionException;
use Lightit\Backoffice\Employee\App\Controllers\StoreEmployeeController;
use Lightit\Backoffice\Task\App\Controllers\UpsertTaskController;

Route::get('/', function(){
    return view('app');
});

Route::post('/employees', StoreEmployeeController::class)->name('employees');

// Route::get('/employees', ListEmployeesController::class);

// Route::get('/tasks', ListTasksController::class);

// Route::get('/tasks/{task}', GetTaskController::class);

// Route::post('/tasks', UpsertTaskController::class)->name('tasks');

Route::get('invalid', static fn() => throw new InvalidActionException("Is not valid"));

Route::get('{unknown}', static fn () => view('app'))->where('unknown', '^(?!api).*$');
