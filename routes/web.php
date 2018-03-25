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

Auth::routes();

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
