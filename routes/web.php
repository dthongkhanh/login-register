<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Task\TaskController;
use App\Jobs\SendEmailJob;
use App\Repositories\Task\TaskRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'task'], function () {
    Route::get('list', [TaskController::class, 'index'])->name('task.list');
    Route::get('create', [TaskController::class, 'create']);
    Route::post('create', [TaskController::class, 'store']);
    Route::get('update/{id}', [TaskController::class, 'edit']);
    Route::post('update/{id}', [TaskController::class, 'update']);
    Route::delete('delete/{id}', [TaskController::class, 'destroy']);
    Route::get('filter-by-status', [TaskController::class, 'filter'])->name('tasks.filter_by_status');
    Route::get('sort-by-time-due', [TaskController::class, 'sort'])->name('tasks.sort_by_time_due');
    Route::get('search', [TaskController::class, 'search'])->name('tasks.search');
});

