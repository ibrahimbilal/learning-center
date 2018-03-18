<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseCategory;

class CourseCategoriesController extends Controller
{
    public function index()
    {
      return view('admin.courses_categories.index' , [
        'data' => CourseCategory::all()
      ]);
    }

    public function add()
    {
      return view('admin.courses_categories.add');
    }

    public function create(Request $request)
    {
      // todo validation
      $c = new CourseCategory;
      $c->name = $request->get('name');
      $c->save();

      // todo redirect to list
    }
}
