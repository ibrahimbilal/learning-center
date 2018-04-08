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
Route::get('/', function () {
    return view('welcome');
});

App::setLocale('ar');

Auth::routes();

Route::get('/change_lang/{lang}', function($lang) {
  session(['current_lang' => $lang]);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('cpanel')->middleware('auth')->group(function() {

  Route::prefix('courses_categories')->group(function() {
    Route::get('', 'CourseCategoriesController@index');
    Route::get('add', 'CourseCategoriesController@add')->name('add_course_category');
    Route::post('create', 'CourseCategoriesController@create')->name('create_course_category');
    Route::get('edit/{id}', 'CourseCategoriesController@edit');
    Route::post('update', 'CourseCategoriesController@update');
    Route::post('delete', 'CourseCategoriesController@delete');
  });

  Route::prefix('courses')->group(function() {
    Route::get('', 'CoursesController@index');
    Route::get('add', 'CoursesController@add')->name('add_course');
    Route::post('create', 'CoursesController@create')->name('create_course');
    Route::get('edit/{id}', 'CoursesController@edit');
    Route::post('update', 'CoursesController@update');
    Route::post('delete', 'CoursesController@delete');
  });

});

// =================================================================================333
Route::prefix('cpanel/teachers')->middleware('auth')->group(function(){
  Route::get('', 'TeachersController@index')->name('teachers_index');

  Route::get('add', 'TeachersController@add')->name('add_teachers');
  Route::post('create', 'TeachersController@create')->name('create_teachers');

  Route::get('edit/{id}', 'TeachersController@edit')->name('edit_teachers');
  Route::post('update', 'TeachersController@update')->name('update_teachers');

  Route::post('delete', 'TeachersController@delete')->name('delete_teachers');
});

// =================================================================================111
Route::prefix('cpanel/students')->middleware('auth')->group(function(){
  Route::get('', 'StudentsController@index')->name('students_index');

  Route::get('add', 'StudentsController@add')->name('add_students');
  Route::post('create', 'StudentsController@create')->name('create_students');

  Route::get('edit/{id}', 'StudentsController@edit')->name('edit_students');
  Route::post('getDetials', 'StudentsController@getDetials')->name('view_students');
  Route::post('update', 'StudentsController@update')->name('update_students');

  Route::post('delete', 'StudentsController@delete')->name('delete_students');
});

// =================================================================================222
Route::prefix('cpanel/sessions')->middleware('auth')->group(function(){
  Route::get('', 'SessionsController@index')->name('sessions_index');

  Route::get('add', 'SessionsController@add')->name('add_sessions');
  Route::post('create', 'SessionsController@create')->name('create_sessions');

  Route::get('edit/{id}', 'SessionsController@edit')->name('edit_sessions');
  Route::post('update', 'SessionsController@update')->name('update_sessions');

  Route::post('delete', 'SessionsController@delete')->name('delete_sessions');
});

// =================================================================================333
Route::prefix('cpanel/rooms')->middleware('auth')->group(function(){
  Route::get('', 'RoomsController@index')->name('rooms_index');

  Route::get('add', 'RoomsController@add')->name('add_rooms');
  Route::post('create', 'RoomsController@create')->name('create_rooms');

  Route::get('edit/{id}', 'RoomsController@edit')->name('edit_rooms');
  Route::post('update', 'RoomsController@update')->name('update_rooms');

  Route::post('delete', 'RoomsController@delete')->name('delete_rooms');
});

Route::prefix('cpanel/students_sessions')->group(function() {
  Route::get('', 'StudentsSessionsController@index');
  Route::get('add', 'StudentsSessionsController@add')->name('add_student_session');
  Route::post('create', 'StudentsSessionsController@create')->name('create_student_session');
  Route::post('delete', 'StudentsSessionsController@delete');
});
