<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\FrontController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [App\Http\Controllers\FrontController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\FrontController::class, 'loginPost'])->name('loginPost');
Route::get('/register', [App\Http\Controllers\FrontController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\FrontController::class, 'registerPost'])->name('registerPost');

Route::get('/files', [App\Http\Controllers\FrontController::class, 'userFiles'])->name('userFiles');
Route::get('/uploads', [App\Http\Controllers\FrontController::class, 'uploads'])->name('uploads');
Route::post('/uploads', [App\Http\Controllers\FrontController::class, 'uploadsPost'])->name('uploadsPost');

//add folder
Route::post('/createfolder', [App\Http\Controllers\FrontController::class, 'createfolder'])->name('createfolder');
Route::get('/folder/{id}', [App\Http\Controllers\FrontController::class, 'singleFolder'])->name('singleFolder');
Route::post('/renameFolder', [App\Http\Controllers\FrontController::class, 'renameFolder'])->name('renameFolder');
Route::post('/renameFile', [App\Http\Controllers\FrontController::class, 'renameFile'])->name('renameFile');
Route::get('/downloadFile/{id}', [App\Http\Controllers\FrontController::class, 'downloadFile'])->name('downloadFile');
Route::get('/deleteFile/{id}', [App\Http\Controllers\FrontController::class, 'deleteFile'])->name('deleteFile');

//singleFile
Route::get('/files', [App\Http\Controllers\FrontController::class, 'files'])->name('files');
Route::get('/singleFile/{id}', [App\Http\Controllers\FrontController::class, 'singleFile'])->name('singleFile');
Route::post('/singleFile/{id}', [App\Http\Controllers\FrontController::class, 'singleFileEdit'])->name('singleFileEdit');

//admin
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('adminDashboard');
Route::get('/admin/files', [App\Http\Controllers\AdminController::class, 'adminFiles'])->name('adminFiles');
Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'adminUsers'])->name('adminUsers');
Route::get('/admin/folders', [App\Http\Controllers\AdminController::class, 'adminFolders'])->name('adminFolders');

Route::get('/admin/roles', [App\Http\Controllers\AdminController::class, 'adminRoles'])->name('adminRoles');
Route::get('/admin/add-roles', [App\Http\Controllers\AdminController::class, 'adminAddRoles'])->name('adminAddRoles');
Route::post('/admin/add-roles', [App\Http\Controllers\AdminController::class, 'adminAddRolesPost'])->name('adminAddRolesPost');
Route::get('/admin/add-permissions/{role_id}', [App\Http\Controllers\AdminController::class, 'adminAddPermissions'])->name('adminAddPermissions');
Route::post('/admin/add-permissions/{role_id}', [App\Http\Controllers\AdminController::class, 'adminAddPermissionsPost'])->name('adminAddPermissionsPost');
Route::get('/admin/assign-user-role-permission/{user_id}', [App\Http\Controllers\AdminController::class, 'adminAssignUserRolePermission'])->name('adminAssignUserRolePermission');
Route::post('/admin/assign-user-role-permission/{user_id}', [App\Http\Controllers\AdminController::class, 'adminAssignUserRolePermissionPost'])->name('adminAssignUserRolePermissionPost');
Route::post('/admin/remove-user-role-permission/{user_id}', [App\Http\Controllers\AdminController::class, 'adminRemoveUserRolePermission'])->name('adminRemoveUserRolePermission');