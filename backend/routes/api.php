<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProjectMembersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClassifierController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
});

Route::prefix('projects')->group(function () {
    Route::get('all', [ProjectsController::class, 'all'])->name('projects.all');
    Route::get('get/{id}', [ProjectsController::class, 'get'])->name('projects.get');
    Route::post('create', [ProjectsController::class, 'create'])->name('projects.create');
    Route::put('update/{id}', [ProjectsController::class, 'update'])->name('projects.update');
    Route::delete('delete/{id}', [ProjectsController::class, 'delete'])->name('projects.delete');
});

Route::prefix('customers')->group(function () {
    Route::get('all', [CustomersController::class, 'all'])->name('customers.all');
    Route::get('get/{id}', [CustomersController::class, 'get'])->name('customers.get');
    Route::post('create', [CustomersController::class, 'create'])->name('customers.create');
    Route::put('update/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('delete/{id}', [CustomersController::class, 'delete'])->name('customers.delete');
});

Route::prefix('users')->group(function () {
    Route::get('all', [UsersController::class, 'all'])->name('users.all');
    Route::get('get/{id}', [UsersController::class, 'get'])->name('users.get');
    Route::post('create', [UsersController::class, 'create'])->name('users.create');
    Route::put('update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('delete/{id}', [UsersController::class, 'delete'])->name('users.delete');
});

Route::prefix('classifiers')->group(function () {
    Route::get('{type}', [ClassifierController::class, 'get'])->name('classifiers.get');
});
