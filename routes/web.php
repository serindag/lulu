<?php

use App\Http\Controllers\Back\AdminBranchController;
use App\Http\Controllers\Back\AdminBranchGroupController;
use App\Http\Controllers\Back\AdminBranchUserController;
use App\Http\Controllers\Back\AdminCategoryController;
use App\Http\Controllers\Back\AdminDashboardController;
use App\Http\Controllers\Back\AdminFeedbackController;
use App\Http\Controllers\Back\AdminLoginController;
use App\Http\Controllers\Back\AdminPopupController;
use App\Http\Controllers\Back\AdminProductController;
use App\Http\Controllers\Back\AdminUserController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\UserController;
use App\Models\Feedback;
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



Route::middleware('admin')->prefix('admin')->name('admin.')->group(function(){

    Route::get('/',[AdminDashboardController::class,'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'destroy'])->name('logout');

    Route::prefix('user')->name('user.')->group(function(){

        Route::get('/',[AdminUserController::class,'form'])->name('form');
        Route::post('/save',[AdminUserController::class,'save'])->name('save');

    });
   

    
    Route::prefix('branch-group')->name('branchGroup.')->group(function(){

        Route::get('/',[AdminBranchGroupController::class,'list'])->name('list');
        Route::get('/new/{id?}',[AdminBranchGroupController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminBranchGroupController::class,'save'])->name('save');
        Route::get('/delete/{id}',[AdminBranchGroupController::class,'delete'])->name('delete');
        Route::get('/status',[AdminBranchGroupController::class,'status'])->name('status');

    });

    Route::prefix('branch')->name('branch.')->group(function(){

        Route::get('/',[AdminBranchController::class,'list'])->name('list');
        Route::get('/new/{id?}',[AdminBranchController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminBranchController::class,'save'])->name('save');
        Route::get('/delete/{id}',[AdminBranchController::class,'delete'])->name('delete');
        Route::get('/status',[AdminBranchController::class,'status'])->name('status');

    });

    Route::prefix('category')->name('category.')->group(function(){

        Route::get('/',[AdminCategoryController::class,'list'])->name('list');
        Route::post('/',[AdminCategoryController::class,'placement'])->name('placement');
        Route::get('/new/{id?}',[AdminCategoryController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminCategoryController::class,'save'])->name('save');
        Route::get('/status',[AdminCategoryController::class,'status'])->name('status');

    });

    Route::prefix('branchUser')->name('branchUser.')->group(function(){
    
        Route::get('/',[AdminBranchUserController::class,'list'])->name('list');
        Route::get('/status',[AdminBranchUserController::class,'status'])->name('status');
        Route::get('/new/{id?}',[AdminBranchUserController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminBranchUserController::class,'save'])->name('save');
        Route::get('/delete/{id}',[AdminBranchUserController::class,'delete'])->name('delete');

    });
    
    Route::prefix('popup')->name('popup.')->group(function(){

        Route::get('/',[AdminPopupController::class,'list'])->name('list');
        Route::get('/status',[AdminPopupController::class,'status'])->name('status');
        Route::get('/new/{id?}',[AdminPopupController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminPopupController::class,'save'])->name('save');
        Route::get('/delete/{id}',[AdminPopupController::class,'delete'])->name('delete');

    });
    
    Route::prefix('product')->name('product.')->group(function(){  

        Route::get('/status',[AdminProductController::class,'status'])->name('status');
        Route::get('/new/{id?}',[AdminProductController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminProductController::class,'save'])->name('save');
        Route::get('/delete/{id}',[AdminProductController::class,'delete'])->name('delete');
        Route::get('/{id?}',[AdminProductController::class,'list'])->name('list');

    });

    Route::prefix('feedback')->name('feedback.')->group(function(){ 
        Route::get('/',[AdminFeedbackController::class,'list'])->name('list');
        Route::get('/{id?}',[AdminFeedbackController::class,'saveform'])->name('saveform');
        Route::post('/new',[AdminFeedbackController::class,'save'])->name('save');
        
    });


    


});

/*End Admin Routes */


/* require __DIR__.'/auth.php'; */
