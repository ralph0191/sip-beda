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


   
    Route::put('/profile/update', 'App\Http\Controllers\UserProfileController@updateUser');
    Route::put('/profile/change-password', 'App\Http\Controllers\UserProfileController@changePassword');
    Route::post('/profile/change-picture', 'App\Http\Controllers\UserProfileController@changeProfilePic');
    

    Route::get('/student/intent-form/approved', 'App\Http\Controllers\IntentFormController@approvedIntentForm');

    Route::get('/student/pre-internship', 'App\Http\Controllers\PreInternshipController@studentView');
    Route::post('/student/pre-internship/attached-file',  'App\Http\Controllers\PreInternshipController@studentUploadFile');
    Route::get('/student/pre-internship/download-file/{fileName}', 'App\Http\Controllers\PreInternshipController@studentDownloadFile');
    Route::get('/student/during-internship', 'App\Http\Controllers\DuringInternshipController@studentView');
    Route::post('/student/during-internship/attached-file',  'App\Http\Controllers\DuringInternshipController@studentUploadFile');
    Route::get('/student/end-internship', 'App\Http\Controllers\EndOfInternshipController@studentView');

    Route::get('/student/pre-internship/chart', 'App\Http\Controllers\DashboardController@getPreInternshipData');
    Route::get('/student/during-internship/chart', 'App\Http\Controllers\DashboardController@getDuringInternshipData');
    Route::get('/student/end-internship/chart', 'App\Http\Controllers\DashboardController@getEndInternshipData');
    
    Route::get('/sip/pre-internship-table', function () {
        return view('sip.pre-internship-table');
    });

    Route::get('/sip/during-internship', function () {
        return view('sip.during-internship-table');
    });

    Route::get('/sip/end-internship-table', function () {
        return view('sip.end-internship-table');
    });

    Route::get('/sip/completed-internship-table', function () {
        return view('sip.completed-internship');
    });

    // Route::get('/sip/completed-internship-table', view('sip.completed-internship'));

    Route::get('/sip/dept-chairs', 'App\Http\Controllers\DeptChairController@deptChairs');
    Route::get('/sip/complete-pre-internship/approved/{id}', 'App\Http\Controllers\PreInternshipController@sipCompleteStudent');
    Route::post('/sip/pre-internship/approve-file/', 'App\Http\Controllers\PreInternshipController@sipApprovedFile');
    Route::get('/sip/pre-internship-table/get-users', 'App\Http\Controllers\PreInternshipController@sipTableView');
    Route::get('/sip/pre-student-view/{id}', 'App\Http\Controllers\PreInternshipController@sipViewStudent');
    Route::get('/sip/pre-internship/download-file/{id}', 'App\Http\Controllers\PreInternshipController@sipDownloadFile');

    Route::get('/sip/during-internship-table/get-users', 'App\Http\Controllers\DuringInternshipController@sipTableView');
    Route::get('/sip/during-student-view/{id}', 'App\Http\Controllers\DuringInternshipController@sipViewStudent');
    Route::get('/sip/complete-during-internship/approved/{id}', 'App\Http\Controllers\DuringInternshipController@sipCompleteStudent');

    Route::get('/sip/end-internship-table/get-users', 'App\Http\Controllers\EndOfInternshipController@sipTableView');
    Route::get('/sip/end-student-view/{id}', 'App\Http\Controllers\EndOfInternshipController@sipViewStudent');
    Route::get('/sip/complete-end-internship/approved/{id}', 'App\Http\Controllers\EndOfInternshipController@sipCompleteStudent');
    Route::get('/sip/dept-chairs/batch/template', 'App\Http\Controllers\DeptChairController@sample');
    Route::post('/sip/dept-chairs/batch/import', 'App\Http\Controllers\DeptChairController@import');
    Route::get('/sip/dept-chairs/paginate', 'App\Http\Controllers\DeptChairController@deptChairPaginate');

    Route::get('/sip/complete-internship-table/get-users', 'App\Http\Controllers\CompletedInternshipController@sipTableView');
    Route::get('/sip/complete-student-view/{id}', 'App\Http\Controllers\CompletedInternshipController@sipViewStudent');

    Route::get('/dept-chair/during-internship', function () {
        return view('dept-chair.during-internship');
    });

    Route::get('/dept-chair/end-internship', function () {
        return view('dept-chair.end-of-internship');
    });

    Route::get('/dept-chair/completed-internship', function () {
        return view('dept-chair.complete-internship');
    });
    
    Route::get('/dept-chair/intent-form', 'App\Http\Controllers\IntentFormController@deptChairView');
    Route::get('/dept-chair/intent-form/approved/{id}' , 'App\Http\Controllers\IntentFormController@deptChairApproved');

    Route::get('/dept-chair/during-internship/get-users', 'App\Http\Controllers\DuringInternshipController@deptChairTable');
    Route::get('/dept-chair/during-student-view/{id}', 'App\Http\Controllers\DuringInternshipController@deptChairTableView');
    Route::post('/dept-chair/during-internship/check-file/', 'App\Http\Controllers\DuringInternshipController@deptChairCheckFile');

    Route::get('/dept-chair/end-internship/get-users', 'App\Http\Controllers\EndOfInternshipController@deptChairTable');
    Route::get('/dept-chair/end-student-view/{id}', 'App\Http\Controllers\EndOfInternshipController@deptChairViewStudent');
    Route::post('/dept-chair/end-internship/check-file/', 'App\Http\Controllers\EndOfInternshipController@deptChairCheckFile');

    Route::get('/dept-chair/complete-end-internship/approved/{id}', 'App\Http\Controllers\EndOfInternshipController@deptChairCompleteStudent');
    Route::get('/dept-chair/complete-during-internship/approved/{id}', 'App\Http\Controllers\DuringInternshipController@deptChairCompleteStudent');
    Route::get('/dept-chair/complete-internship/get-users', 'App\Http\Controllers\CompletedInternshipController@deptChairTable');
    Route::get('/dept-chair/complete-student-view/{id}', 'App\Http\Controllers\CompletedInternshipController@deptChairViewStudent');

    Route::get('/dept-chair/intent-forms/chart', 'App\Http\Controllers\DashboardController@deptChairIntentForms');
    Route::get('/dept-chair/during-internship/chart', 'App\Http\Controllers\DashboardController@deptChairDuringInternship');
    Route::get('/dept-chair/end-internship/chart', 'App\Http\Controllers\DashboardController@deptChairEndInternship');

    

    
    
});


// Route::group(['middleware' => ['deptchair']], function () {
   
// });





