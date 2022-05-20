<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SubsController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AdminController::class , 'login'])->name('admin.login');
Route::post('admin-login', [AdminController::class, 'loginSubmit'])->name('admin.login_submit');
Route::middleware(['admin_middleware'])->group(function () {
    
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'adminLogout'])->name('admin.logout');
    Route::get('/subscription', [SubsController::class, 'index'])->name('admin.subs');
    Route::get('/subscription-list', [SubsController::class, 'subscriptionList'])->name('subs.list');
    Route::post('/manage-subscription', [SubsController::class, 'manageSubscriptionSubmit'])->name('manage.subs.submit');
    Route::post('delete-subscription', [SubsController::class, 'deleteSubscription'])->name('delete.subs.submit');

});


?>