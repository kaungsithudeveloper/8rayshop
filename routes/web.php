<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;

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
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//Backend Auth Route
Route::middleware(['auth','role:admin'])->group(function () {

    //Backend Admin Route
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logOut'])->name('admin.logout');
    Route::get('/admins/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admins',[AdminController::class, 'AllAdmin'])->name('all.admin');
    Route::get('/add/admin',[AdminController::class, 'AddAdmin'])->name('add.admin');
    Route::post('/admin/user/store', [AdminController::class, 'AdminUserStore'])->name('admin.user.store');
    Route::get('/edit/admin/role/{id}' , [AdminController::class, 'EditAdminRole'])->name('edit.admin.role');
    Route::post('/admin/user/update/{id}', [AdminController::class, 'AdminUserUpdate'])->name('admin.user.update');
    Route::get('/delete/admin/role/{id}' , [AdminController::class, 'DeleteAdminRole'])->name('delete.admin.role');


    //Backend Admin Route
    Route::get('/employee',[EmployeeController::class, 'AllEmployee'])->name('all.employee');
    Route::get('/add/employee',[EmployeeController::class, 'AddEmployee'])->name('add.employee');
    Route::post('/store/employee/user', [EmployeeController::class, 'StoreEmployee'])->name('store.employee');
    Route::get('/edit/employee/{id}' , [EmployeeController::class, 'EditEmployee'])->name('edit.employee');
    Route::post('/update/employee/{id}', [EmployeeController::class, 'UpdateEmployee'])->name('update.employee');
    Route::get('/delete/employee/{id}' , [EmployeeController::class, 'DeleteEmployee'])->name('delete.employee');

    //Backend Blog Route
    Route::get('backend/blogs',[BlogController::class, 'index'])->name('blogs');
    Route::get('backend/blogs/active',[BlogController::class, 'ActivePost'])->name('blogs.active');
    Route::get('backend/blogs/inactive',[BlogController::class, 'InactivePost'])->name('blogs.inactive');
    Route::get('backend/blogs/inactive/{id}' , [BlogController::class, 'PostInactive'])->name('post.inactive');
    Route::get('backend/blogs/active/{id}' , [BlogController::class, 'PostActive'])->name('post.active');
    Route::get('backend/posts/create',[BlogController::class, 'create'])->name('posts.create');
    Route::post('backend/posts/store',[BlogController::class, 'store'])->name('posts.store');
    Route::get('backend/posts/edit/{id}',[BlogController::class, 'edit'])->name('posts.edit');
    Route::post('backend/posts/update',[BlogController::class, 'update'])->name('posts.update');
    Route::get('backend/posts/delete/{id}' , [BlogController::class, 'destroy'])->name('posts.delete');

    //Backend Role & Permission Route
    //Backend Permission Route
    Route::get('backend/all/permission',[RoleController::class, 'AllPermission'])->name('all.permission');
    Route::get('backend/add/permission',[RoleController::class, 'AddPermission'])->name('add.permission');
    Route::post('backend/store/permission',[RoleController::class, 'StorePermission'])->name('store.permission');
    Route::get('backend/edit/permission/{id}',[RoleController::class, 'EditPermission'])->name('edit.permission');
    Route::post('backend/update/permission',[RoleController::class, 'UpdatePermission'])->name('update.permission');
    Route::get('backend/delete/permission/{id}',[RoleController::class, 'DeletePermission'])->name('delete.permission');

    //Backend Role Route
    Route::get('backend/all/roles',[RoleController::class, 'AllRoles'])->name('all.roles');
    Route::get('backend/add/roles',[RoleController::class, 'AddRoles'])->name('add.roles');
    Route::post('backend/store/roles',[RoleController::class, 'StoreRoles'])->name('store.roles');
    Route::get('backend/edit/roles/{id}',[RoleController::class, 'EditRoles'])->name('edit.roles');
    Route::post('backend/update/roles',[RoleController::class, 'UpdateRoles'])->name('update.roles');
    Route::get('backend/delete/roles/{id}',[RoleController::class, 'DeleteRoles'])->name('delete.roles');

    // add role permission
    Route::get('backend/add/roles/permission',[RoleController::class, 'AddRolesPermission'])->name('add.roles.permission');
    Route::post('backend/role/permission/store',[RoleController::class, 'RolePermissionStore'])->name('role.permission.store');
    Route::get('backend/all/roles/permission',[RoleController::class, 'AllRolesPermission'])->name('all.roles.permission');
    Route::get('backend/admin/edit/roles/{id}',[RoleController::class, 'AdminRolesEdit'])->name('admin.edit.roles');
    Route::post('backend/admin/roles/update/{id}',[RoleController::class, 'AdminRolesUpdate'])->name('admin.roles.update');
    Route::get('backend/admin/delete/roles/{id}',[RoleController::class, 'AdminRolesDelete'])->name('admin.delete.roles');

});

//Backend Auth Admin End

require __DIR__.'/auth.php';
