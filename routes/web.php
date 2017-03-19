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

/* Admin Routes*/
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::get('/adminauth', 'PagesController@adminauth');
    Route::get('/masterscheduleview', 'PagesController@masterscheduleview');
    Route::get('/editschedule', 'PagesController@editschedule');

    Route::get('/draganddropschedule', 'PagesController@draganddropschedule');


    /* InstructorController */

    Route::get('/manageInstructor', 'InstructorController@manageInstructor');

    Route::get('/manageInstructor', 'InstructorController@index');


    Route::post('/courseInstructor', 'InstructorController@assign');

    Route::post('/manageInstructor', 'InstructorController@store');

    Route::post('/editInstructor', 'InstructorController@edit');

    Route::post('/showInstructorDetails', 'AjaxController@instructorDetails');

    /* CourseController */

    Route::get('/manageCourse', 'CourseController@manageCourse');

    Route::get('/manageCourse', 'CourseController@index');

    Route::post('/manageCourseStore', 'CourseController@store');

    Route::post('/manageCourse', 'CourseController@updateCourse');

    Route::get('/assign', 'AssignController@index');

    /* ScheduleController */

    Route::get('/dragDrop', 'ScheduleController@index');

    Route::post('/dragDrop', 'ScheduleController@displayRoomsByWeek');

// Route::post('/dragDrop', 'ScheduleController@store');

    Route::get('/addschedule', 'ScheduleController@index');
});

/* Staff Routes*/
Route::group(['middleware' => 'App\Http\Middleware\StaffMiddleware'], function()
{
    Route::get('/staffauth', 'PagesController@staffauth');
    Route::get('/schedulestaff', 'PagesController@schedulestaff');
});

Route::post('/updateCourse', 'CourseController@updateCourse');

Route::get('/assign', 'AssignController@index');
/* Student Routes*/
Route::group(['middleware' => 'App\Http\Middleware\StudentMiddleware'], function()
{
    Route::get('/studauth', 'PagesController@studauth');
    Route::get('/schedulestudent', 'PagesController@schedulestudent');
});

/* Public Pages */

Auth::routes();

Route::get('/', 'PagesController@home');

Route::get('/about', 'PagesController@about');

Route::get('/home', 'HomeController@index');

Route::get('/test','Tester@index');
