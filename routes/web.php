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
        // Auth::routes();
        Route::any('/login', 'Auth\LoginController@login')->name('login'); 
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');     
    });
    Route::get('/', 'HomeController@webIndex')->name('web.index');
    Route::post('/signup', 'Auth\LoginController@signup')->name('signup');
    Route::post('/user/login', 'Auth\LoginController@userLogin')->name('userLogin');
    Route::middleware('auth:web')->prefix('user')->group(function(){
        Route::get('/home', 'HomeController@webHome')->name('web.home');
        Route::get('/user-logout', 'Auth\LoginController@userLogout')->name('userLogout');

    });
    
    Route::middleware('auth:admin')->prefix('admin')->group(function(){
        Route::get('/dashboard', 'HomeController@index')->name('admin.home');
        Route::resource('users', 'UserController');
        Route::resource('role', 'RoleController');
        Route::get('/user/changeStatus/{id}','UserController@changeStatus')->name('user.changeStatus');
        Route::get('user/profile','UserController@profile')->name('user.profile');
        Route::get('user/update-profile','UserController@showUpdateProfileForm')->name('user.updateProfile');
        Route::post('user/update-profile','UserController@updateProfile')->name('user.updateProfile.submit');
        Route::get('user/change-password','UserController@changePasswordView')->name('user.changePassword');
        Route::post('user/change-password','UserController@changePassword')->name('user.changePassword.submit');
        
        Route::resource('email-queue', 'EmailQueueController');

    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
