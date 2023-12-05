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
    Route::middleware('auth:web')->prefix('user')->group(function(){
        Route::get('/home', 'Web\HomeController@webHome')->name('web.home');
        Route::get('/user-logout', 'Web\AuthController@userLogout')->name('userLogout');
        Route::get('/get-profile-data', 'Web\HomeController@getProfileData')->name('getProfileData');
        Route::post('/add/prescription', 'Web\HomeController@addPrescription')->name('addPrescription');
        Route::post('/get/prescription/list', 'Web\HomeController@getTraumaData')->name('getTraumaData');
        Route::post('/delete/card', 'Web\HomeController@deleteTraumaCard')->name('deleteTraumaCard');
        Route::post('/add/buttons', 'Web\HomeController@addTags')->name('addTags');
        Route::post('/update-profile', 'Web\HomeController@updateProfile')->name('updateProfile');
        Route::post('/change-password', 'Web\AuthController@changePassword')->name('changePassword');
        Route::post('/delete/button', 'Web\HomeController@deleteButtons')->name('deleteButtons');
        Route::post('/add/search/tags', 'Web\HomeController@addSearchableTags')->name('addSearchableTags');
        Route::post('/get-button-description', 'Web\HomeController@')->name('getButtonDescription');

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
    });
});

