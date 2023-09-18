<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');


    // permissions
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permission-list', 'index')->name('permission');
        Route::get('/permission/create', 'create')->name('permission.create');
        Route::post('/permission/store', 'store')->name('permission.store');
        Route::get('/permission/edit/{id}', 'edit')->name('permission.edit');
        Route::post('/permission/update', 'update')->name('permission.update');
        Route::get('/permission/delete/{id}', 'delete')->name('permission.delete');

        Route::get('/role/permission-add', 'addRolePermission')->name('add.role.permission');
        Route::post('/role/permission/store', 'rolePermissionStore')->name('role.permission.store');
    });


    // Roles
    Route::controller(RoleController::class)->group(function () {
        Route::get('/role-list', 'index')->name('role');
        Route::get('/role/create', 'create')->name('role.create');
        Route::post('/role/store', 'store')->name('role.store');
        Route::get('/role/edit/{id}', 'edit')->name('role.edit');
        Route::post('/role/update', 'update')->name('role.update');
        Route::get('/role/delete/{id}', 'delete')->name('role.delete');


        Route::get('/role/permission-assign/', 'rolePermission')->name('role.permission');
        Route::get('/edit/role/permission/{id}', 'editRolePermission')->name('edit.role.permission');
        Route::post('/role/permission/update/', 'rolePermissionUpdate')->name('role.permission.update');

        Route::get('/delete/role/permission/{id}', 'deleteRolePermission')->name('delete.role.permission');
    });


    Route::get('/user', [UserController::class, 'user'])->name('user');
    Route::post('/user/approval', [UserController::class, 'userApprove'])->name('user.approval');
    Route::get('/user/delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');
});

require __DIR__ . '/auth.php';
