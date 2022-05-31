<?php

use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\AdminBranchGroupController;
use App\Http\Controllers\AdminCategoryController;
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

    Route::get('admin/branch-group',[AdminBranchGroupController::class,'list'])->name('admin.branchGroup');
    Route::get('admin/branch-group/new/{id?}',[AdminBranchGroupController::class,'saveform'])->name('admin.branchGroup.saveform');

    Route::post('admin/branch-group/new',[AdminBranchGroupController::class,'save'])->name('admin.branchGroup.save');

    Route::get('admin/branch-group/delete/{id}',[AdminBranchGroupController::class,'delete'])->name('admin.branchGroup.delete');
    Route::get('admin/branch-group/status',[AdminBranchGroupController::class,'status'])->name('admin.branchGroup.status');



    Route::get('admin/branch',[AdminBranchController::class,'list'])->name('admin.branch');
    Route::get('admin/branch/new/{id?}',[AdminBranchController::class,'saveform'])->name('admin.branch.saveform');
    Route::post('admin/branch/new',[AdminBranchController::class,'save'])->name('admin.branch.save');
    Route::get('admin/branch/delete/{id}',[AdminBranchController::class,'delete'])->name('admin.branch.delete');
    Route::get('admin//branch/status',[AdminBranchController::class,'status'])->name('admin.branch.status');


    Route::get('admin/category',[AdminCategoryController::class,'list'])->name('admin.category.list');
    Route::post('admin/category',[AdminCategoryController::class,'placement'])->name('admin.category.placement');
    Route::get('admin/category/new/{id?}',[AdminCategoryController::class,'saveform'])->name('admin.category.saveform');
    Route::post('admin/category/new',[AdminCategoryController::class,'save'])->name('admin.category.save');
    Route::get('admin/category/status',[AdminCategoryController::class,'status'])->name('admin.category.status');

});

/*End Admin Routes */


/* require __DIR__.'/auth.php'; */
