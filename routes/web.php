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

    /* TermController */
    Route::get('/manageTerm', 'TermController@index');
    Route::post('/saveTerm', 'TermController@createTerm');
    Route::post('/manageTerm', 'TermController@store');
    Route::post('/searchTerm', 'TermController@searchTerm');
    Route::get('/searchTerm', 'TermController@index');
    Route::post('/deleteTerm', 'TermController@delete');

    //Route::get('/searchTerm', 'AjaxController@searchTerm');

    /* InstructorController */
    Route::get('/manageInstructor', 'InstructorController@manageInstructor');
    Route::get('/manageInstructor', 'InstructorController@index');
    Route::get('/searchInstructor', 'AjaxController@searchInstructor');
    Route::post('/updateCourse', 'CourseController@updateCourse');
    Route::post('/courseInstructor', 'InstructorController@assign');
    Route::post('/manageInstructor', 'InstructorController@store');
    Route::post('/editInstructor', 'InstructorController@edit');
    Route::post('/showInstructorDetails', 'AjaxController@instructorDetails');
    Route::post('/deleteCourseInstructor', 'InstructorController@delete');

    /* CourseController */
    Route::get('/manageCourse', 'CourseController@manageCourse');
    Route::get('/manageCourse', 'CourseController@index');
    Route::post('/manageCourseStore', 'CourseController@store');
    Route::post('/manageCourseUpdate', 'CourseController@updateCourse');
    Route::post('/manageCourseDelete', 'CourseController@deleteCourse');
    Route::get('/searchCourse','AjaxController@searchCourse');

    /* ScheduleController */
    Route::get('/dragDrop', 'ScheduleController@index');
    Route::post('/dragDrop', 'ScheduleController@displayRoomsByWeek');
    Route::post('/addschedule', 'ScheduleController@store');
    Route::get('/addschedule', 'ScheduleController@index');
    Route::post('/dragDropGetWeeklySchedule', 'AjaxController@getWeeklySchedule');
    Route::get('/selecttermschedule', 'ScheduleController@selectTerm');

    /* AssignController*/
    Route::get('/assign', 'AssignController@index');
    Route::post('/assignCourse', 'AssignController@assignCourse');
    Route::get('/unassignCourse', 'AssignController@unassignCourse');
    Route::post('/getInstructorsForACourse', 'AjaxController@getInstructorsForACourse');
    Route::get('/addschedule', 'ScheduleController@index');

    /* IntakeController */
    Route::get('/manageIntake', 'IntakeController@index');
    Route::post('/manageIntake', 'IntakeController@store');
    Route::get('/updateIntake', 'IntakeController@index');
    Route::post('/updateIntake', 'IntakeController@updateIntake');
    /* Propagation Controller */
    Route::post('/getCourseOfferingsByTerm', 'AjaxController@getCourseOfferingsByTerm');
    Route::post('/getWeeklySchedule', 'AjaxController@getWeeklySchedule');
    Route::post('/extend', 'PropagationController@extend');
    Route::get('/propagateschedule', 'PagesController@propagateschedule');

    /* Student Controller */
    Route::get('/manageStudents/', 'StudentController@index');

    /* OnPropFinish Controller */
    Route::get('/propfinish/{date}', 'OnPropFinishController@index');
});

/* Staff Routes*/
Route::group(['middleware' => 'App\Http\Middleware\StaffMiddleware'], function()
{
    Route::get('/staffauth', 'PagesController@staffauth');
    Route::get('/schedulestaff', 'PagesController@schedulestaff');
});

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

Route::get('/debug', 'PropagationController@getHolidayArray');
