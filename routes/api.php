<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['auth:api'], function(){

    /**********  Student endpoints  ************/
    Route::get('/students', 'Api\StudentController@index');
    Route::get('/students/{student_id}', 'Api\StudentController@show');
    Route::patch('/students/{student_id}', 'Api\StudentController@update');
    Route::post('/students', 'Api\StudentController@store');
    Route::delete('/students/{student_id}', 'Api\StudentController@delete');

    /**********  Course endpoints  ************/
    Route::get('/courses', 'Api\CourseController@index');
    Route::get('/courses/{course_id}', 'Api\CourseController@show');
    Route::patch('/courses/{course_id}', 'Api\CourseController@update');
    Route::post('/courses', 'Api\CourseController@store');
    Route::delete('/courses/{course_id}', 'Api\CourseController@delete');

    /**********  Teacher endpoints  ************/
    Route::get('/teachers', 'Api\TeacherController@index');
    Route::get('/teachers/{teacher_id}', 'Api\TeacherController@show');
    Route::patch('/teachers/{teacher_id}', 'Api\TeacherController@update');
    Route::post('/teachers', 'Api\TeacherController@store');
    Route::delete('/teachers/{teacher_id}', 'Api\TeacherController@delete');

});

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');
