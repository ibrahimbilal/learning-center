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
// dd(env('DB_PASSWORD'));
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('cpanel/courses_categories', 'CourseCategoriesController@index');

Route::get('cpanel/courses_categories/add', 'CourseCategoriesController@add')->name('add_course_category');
Route::post('cpanel/courses_categories/create', 'CourseCategoriesController@create')->name('create_course_category');


Route::get('cpanel/courses_categories/edit/{id}', 'CourseCategoriesController@edit');
