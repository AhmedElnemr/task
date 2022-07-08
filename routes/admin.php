<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin'], function () {

    Config::set('auth.defines', 'admin');

    /*==================== Auth System  ==================*/

    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AdminLoginController@login')->name('admin.login.submit');

    /*==================== Admin Panel ==================*/

    Route::group(['middleware' => 'admin:admin'], function () {

        /*================LogOut===========*/
        Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');


        Route::get('/home', 'AdminController@index')->name('admin.dashboard');
        Route::get('calender', 'AdminController@calender')->name('admin.calender');


        //Profile
        Route::resource('profileControl', 'Profile\AdminProfileController');

        /*================Admin Setting control =========================*/

        Route::resource('settings','AdminSettingController');//setting

        /*================Admin Contact us control =========================*/

        Route::resource('contacts','AdminContactUsController');


        /*================Admin Profile control =========================*/

        Route::resource('profile','AdminProfileController');

        /*================Admin Admin control =========================*/
        Route::resource('admins','AdminAdminController');
        Route::delete('admins/delete/bulk','AdminAdminController@delete_all')->name('admins.delete.bulk');

       /*================Admin Users control =========================*/
        Route::resource('users','AdminUserController');
        Route::delete('users/delete/bulk','AdminUserController@delete_all')
            ->name('users.delete.bulk');
        Route::get('users/changeBlock/{id}','AdminUserController@changeBlock')
            ->name('users.changeBlock');



    });//end middleware admin


});
