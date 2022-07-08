<?php

Route::get('/',function (){
   return view('admin.auth.login');
})->name('admin.login');

Route::view('app-setting','setting');
