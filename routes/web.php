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

Route::middleware('prevent-back-history')->group(function (){

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        
        return Redirect::back()->with('success', 'All cache cleared successfully.');
    });
    Route::group(['prefix' => 'admin'], function(){  
        Auth::routes();    
    });
    Route::get('/', 'Web\AuthController@webIndex')->name('web.index')->middleware('guest');
    Route::post('/signup', 'Web\AuthController@signup')->name('signup');
    Route::post('/user/login', 'Web\AuthController@userLogin')->name('userLogin');
    Route::get('/user/forget/password/view', 'Web\AuthController@forgetPasswordView')->name('forgetPasswordView');
    Route::post('/user/forget/password', 'Web\AuthController@forgetPassword')->name('forgetPassword');
    Route::any('/user/verify/otp/view/{id?}', 'Web\AuthController@verifyOtp')->name('verifyOtpView');
    Route::any('/user/change/password/view/{id?}', 'Web\AuthController@changePassword')->name('changePasswordWeb');
    Route::get('/user/resend/otp/{id?}', 'Web\AuthController@resendOtp')->name('resendOtpWeb');
    Route::middleware('auth:web')->prefix('user')->group(function(){
        Route::get('/home', 'Web\HomeController@webHome')->name('web.home');
        Route::get('/user-logout', 'Web\AuthController@userLogout')->name('userLogout');
        Route::get('/get-profile-data', 'Web\HomeController@getProfileData')->name('getProfileData');
        Route::post('/add/prescription', 'Web\HomeController@addPrescription')->name('addPrescription');
        Route::post('/get/prescription/list', 'Web\HomeController@getTraumaData')->name('getTraumaData');
        Route::post('/delete/card', 'Web\HomeController@deleteTraumaCard')->name('deleteTraumaCard');
        Route::post('/add/buttons', 'Web\HomeController@addTags')->name('addTags');
        Route::get('/edit/buttons/{id}', 'Web\HomeController@editButton')->name('editButton');
        Route::post('/update/buttons', 'Web\HomeController@updateButton')->name('updateButton');
        Route::post('/update-profile', 'Web\HomeController@updateProfile')->name('updateProfile');
        Route::post('/change-password', 'Web\AuthController@changePassword')->name('changePassword');
        Route::post('/delete/button', 'Web\HomeController@deleteButtons')->name('deleteButtons');
        Route::post('/add/search/tags', 'Web\HomeController@addSearchableTags')->name('addSearchableTags');
        Route::post('/get-button-description', 'Web\HomeController@getButtonDescription')->name('getButtonDescription');
        Route::get('/prescription/data', 'Web\HomeController@getPrescription')->name('getPrescription');
        Route::post('/delete/left/tags', 'Web\HomeController@deleteLeftTags')->name('deleteLeftTags');
        Route::get('get/edit/prescreption/{id}','Web\HomeController@getPrescriptionEdit')->name('user.getPrescriptionEdit');
        Route::post('/edit/prescreption', 'Web\HomeController@editPrescreption')->name('user.editPrescreption');
        Route::get('/groups', 'Web\HomeController@getAllUserCards')->name("groups");
        Route::get('/groups/view/{id}', 'Web\HomeController@viewCards');
        Route::post('/groups/editGroupName', 'Web\HomeController@editGroupName');
        Route::get('/groups/copy/{id}', 'Web\HomeController@copyGroup')->name('copyGroup');
        Route::any('/groups/editMainGroup/{id?}', 'Web\HomeController@editMainGroup')->name('editMainGroup');
        Route::any('/groups/updateGroupName/{id?}', 'Web\HomeController@updateGroupName')->name('updateGroupName');
        Route::post('/inner/lable/store', 'Web\HomeController@copyGroup')->name('inner.lable.store');
        Route::post('/delete/group/{id?}', 'Web\HomeController@deleteGroup')->name('deleteGroup');
        Route::post('/delete/deleteOwnRecord/{id?}', 'Web\HomeController@deleteOwnRecord')->name('deleteOwnRecord');
        // update/order/tags
        Route::post('/update/order/tags', 'Web\HomeController@updateOrderOfTags')->name('updateOrderOfTags');
        
        
    });
    
    Route::middleware('auth:admin')->prefix('admin')->group(function(){
        Route::get('/dashboard', 'Admin\HomeController@index')->name('admin.home');
        Route::get('/prescription/data', 'Admin\HomeController@getPrescription')->name('getPrescription');
        Route::resource('users', 'Admin\UserController');
        Route::resource('role', 'Admin\RoleController');
        Route::get('/user/changeStatus/{id}','Admin\UserController@changeStatus')->name('user.changeStatus');
        Route::get('user/profile','Admin\UserController@profile')->name('user.profile');
        Route::get('user/update-profile','Admin\UserController@showUpdateProfileForm')->name('user.updateProfile');
        Route::post('user/update-profile','Admin\UserController@updateProfile')->name('user.updateProfile.submit');
        Route::get('user/change-password','Admin\UserController@changePasswordView')->name('user.changePassword');
        Route::post('user/change-password','Admin\UserController@changePassword')->name('user.changePassword.submit');
        Route::get('copy/to/user','Admin\HomeController@getCopyPrescriptionModal')->name('admin.getCopyPrescriptionModal');
        Route::get('copy/all/to/user','Admin\HomeController@CopyAllPrescriptionModal')->name('admin.CopyAllPrescriptionModal');
        Route::post('save/copy/data','Admin\HomeController@saveCopiedData')->name('admin.saveCopiedData');
        Route::post('save','Admin\HomeController@saveAllCopiedData')->name('admin.saveAllCopiedData');
        Route::get('get/edit/prescreption/{id}','Admin\HomeController@getPrescriptionEdit')->name('admin.getPrescriptionEdit');
        Route::post('submit/edit/prescreption','Admin\HomeController@editPrescreption')->name('admin.editPrescreption');
    });
});

