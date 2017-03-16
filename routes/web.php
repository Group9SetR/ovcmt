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

/* PagesController */
Route::get('/', 'PagesController@home');

Route::get('/about', 'PagesController@about');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/adminauth', 'PagesController@adminauth');

Route::get('/staffauth', 'PagesController@staffauth');

Route::get('/studauth', 'PagesController@studauth');

Route::get('/masterscheduleview', 'PagesController@masterscheduleview');

Route::get('/schedulestudent', 'PagesController@schedulestudent');

Route::get('/schedulestaff', 'PagesController@schedulestaff');

Route::get('/editschedule', 'PagesController@editschedule');

Route::get('/addcourse', 'PagesController@addcourse');

Route::get('/draganddropschedule', 'PagesController@draganddropschedule');

/* InstructorController */

Route::get('/manageInstructor', 'InstructorController@manageInstructor');

Route::post('/manageInstructor', 'InstructorController@store');

/* CourseController */

Route::get('/manageCourse', 'CourseController@manageCourse');

Route::post('/manageCourse', 'CourseController@store');

/* ScheduleController */

Route::get('/dragDrop', 'ScheduleController@dragDrop');

Route::get('/addschedule', 'ScheduleController@index');

Route::get('/test','Tester@index');
