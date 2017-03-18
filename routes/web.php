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

Route::get('/draganddropschedule', 'PagesController@draganddropschedule');


/* InstructorController */

Route::get('/manageInstructor', 'InstructorController@manageInstructor');

Route::get('/manageInstructor', 'InstructorController@index');

Route::post('/manageInstructor', 'InstructorController@store');

Route::post('/showInstructorDetails', 'AjaxController@instructorDetails');

/* CourseController */

Route::get('/manageCourse', 'CourseController@manageCourse');

Route::get('/manageCourse', 'CourseController@index');

Route::post('/manageCourse', 'CourseController@store');

Route::get('/assign', 'AssignController@index');

/* ScheduleController */

Route::get('/dragDrop', 'ScheduleController@dragDrop');

// Route::post('/dragDrop', 'ScheduleController@store');

Route::get('/addschedule', 'ScheduleController@index');

Route::get('/test','Tester@index');
