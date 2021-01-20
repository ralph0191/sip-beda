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


Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/courses', 'App\Http\Controllers\CourseController@getAllCourses');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile/form-profile', function () {
        return view('profile/form-profile');
    });

    Route::get('/student/pre-internship', function () {
        return view('students/pre-internship');
    });
    Route::get('/student/intent-form', function () {
        return view('students/intent-form');
    });

    Route::get('/profile', function () {
        return view('profile/index');
    });

    Route::get('/student/intent-form/approved', 'App\Http\Controllers\IntentFormController@approvedIntentForm');

    Route::get('/student/pre-internship', 'App\Http\Controllers\PreInternshipController@studentView');
    Route::post('/student/pre-internship/attached-file',  'App\Http\Controllers\PreInternshipController@studentUploadFile');
    Route::get('/student/pre-internship/download-file/{fileName}', 'App\Http\Controllers\PreInternshipController@studentDownloadFile');


    Route::get('/sip/complete-pre-internship/approved/{id}', 'App\Http\Controllers\PreInternshipController@sipCompleteStudent');
    Route::post('/sip/pre-internship/approve-file/', 'App\Http\Controllers\PreInternshipController@sipApprovedFile');
    Route::get('/sip/pre-internship-table', 'App\Http\Controllers\PreInternshipController@sipTableView');
    Route::get('/sip/pre-student-view/{id}', 'App\Http\Controllers\PreInternshipController@sipViewStudent');
    Route::get('/sip/pre-internship/download-file/{id}', 'App\Http\Controllers\PreInternshipController@sipDownloadFile');

    Route::get('/dept-chair/intent-form', 'App\Http\Controllers\IntentFormController@deptChairView');
    Route::get('/dept-chair/during-internship', 'App\Http\Controllers\IntentFormController@deptChairView');
    Route::get('/dept-chair/end-of-internship', 'App\Http\Controllers\IntentFormController@deptChairView');

    Route::get('/dept-chair/intent-form/approved/{id}' , 'App\Http\Controllers\IntentFormController@deptChairApproved');
});


// Route::group(['middleware' => ['deptchair']], function () {
   
// });





