<?php

use App\Http\Controllers\AdminBranchGroup;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

/* User Routes */
 Route::middleware('guest')->group(function () {
    Route::get('/user/login',[LoginController::class,'index'])->name('user.login.singIn');
    Route::post('/user/login', [LoginController::class, 'login'])->name('user.login.login');

});




 Route::middleware('auth')->group(function () {
 Route::get('/user',[DashboardController::class,'index'])->name('user.dashboard');
 Route::get('/user/user',[UserController::class,'form'])->name('user.user.form');
 Route::post('/user/user/save',[UserController::class,'save'])->name('user.user.save');
 Route::get('/user/logout', [LoginController::class, 'destroy'])->name('user.logout');

});

/*End User Routes */








/*Admin Routes */

 Route::middleware('adminlogin')->group(function(){

    Route::get('/admin/login',[AdminLoginController::class,'index'])->name('admin.login.singIn');
    Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.login');


});



Route::middleware('admin')->group(function(){

    Route::get('/admin',[AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/user',[AdminUserController::class,'form'])->name('admin.user.form');
    Route::post('/admin/user/save',[AdminUserController::class,'save'])->name('admin.user.save');
    Route::get('/admin/popup',[PopupController::class,'list'])->name('admin.popup.list');
    Route::get('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');
    Route::get('admin/branch-group',[AdminBranchGroup::class,'list'])->name('admin.branchGroup');
    Route::get('admin/branch-group/new',[AdminBranchGroup::class,'saveform'])->name('admin.branchGroup.saveform');

    Route::post('admin/branch-group/new',[AdminBranchGroup::class,'save'])->name('admin.branchGroup.save');

    Route::get('admin/branch-group/edit/{id}',[AdminBranchGroup::class,'editform'])->name('admin.branchGroup.editform');
    Route::post('admin/branch-group/update',[AdminBranchGroup::class,'update'])->name('admin.branchGroup.update');
    Route::get('admin/branch-group/delete/{id}',[AdminBranchGroup::class,'delete'])->name('admin.branchGroup.delete');

});

/*End Admin Routes */


/* require __DIR__.'/auth.php'; */
