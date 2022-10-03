<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminForgotPasswordController;
use App\Http\Controllers\Backend\AdminResetPasswordController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PackageDetailsController;
use App\Http\Controllers\Backend\PackagePricingController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/cc', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>All Config cleared</h1>';
});

Route::get('/', function () {
    return view('welcome');
});

//backend
Route::prefix('/admin')->name('admin.auth.')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/store-login', [AdminAuthController::class, 'storeLogin'])->name('storeLogin');

    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AdminResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //admin management
    Route::controller(AdminAuthController::class)->name('auth.')->group(function () {
        Route::get('/admin-list', 'adminList')->name('adminList');
        Route::get('/create-admin', 'createAdmin')->name('createAdmin');
        Route::post('/store-admin', 'storeAdmin')->name('storeAdmin');
        Route::get('/edit-admin/{admin}', 'editAdmin')->name('editAdmin');
        Route::post('/update-admin/{admin}', 'updateAdmin')->name('updateAdmin');
        Route::post('/active-admin/{admin}', 'activeAdmin')->name('activeAdmin');
        Route::post('/inactive-admin/{admin}', 'inactiveAdmin')->name('inactiveAdmin');
        Route::delete('/delete-admin/{admin}', 'deleteAdmin')->name('deleteAdmin');

        Route::get('/customer-list', 'customerList')->name('customerList');
    });

    Route::resources([
        'packages'        => PackageController::class,
        'package_details' => PackageDetailsController::class,
        'package_pricings' => PackagePricingController::class,
    ]);

    //company info
    Route::controller(CompanyInfoController::class)->group(function () {
        Route::get('/company-info', 'showCompanyInfo')->name('showCompanyInfo');
        Route::post('/store-company-info', 'storeCompanyInfo')->name('storeCompanyInfo');
    });
    //pages
    Route::controller(PageController::class)->prefix('/pages')->name('pages.')->group(function () {
        Route::get('/pages', 'pageList')->name('pageList');
        Route::get('/create-pages', 'pageCreate')->name('pageCreate');
        Route::post('/store-pages', 'pageStore')->name('pageStore');
        Route::get('/edit-pages/{page}', 'pageEdit')->name('pageEdit');
        Route::put('/update-pages/{page}', 'pageUpdate')->name('pageUpdate');
        Route::delete('/delete-pages/{page}', 'pageDelete')->name('pageDelete');
        Route::post('/active-pages/{page}', 'pageActive')->name('pageActive');
        Route::post('/inactive-pages/{page}', 'pageInactive')->name('pageInactive');
    });
});
