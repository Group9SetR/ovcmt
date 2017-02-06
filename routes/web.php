<?php

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

Route::get('/', 'PagesController@home');

Route::get('/about', 'PagesController@about');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/adminauth', 'PagesController@adminauth');

Route::get('/staffauth', 'PagesController@staffauth');

Route::get('/studauth', 'PagesController@studauth');

Route::get('/register', 'PagesController@register');

Route::get('/tolschedualview', 'PagesController@tolschedualview');

Route::get('/addschedual', 'PagesController@addschedual');

Route::get('/schedual_student', 'PagesController@schedual_student');

Route::get('/schedual_staff', 'PagesController@schedual_staff');

Route::get('/editSchedule', 'PagesController@editSchedule');