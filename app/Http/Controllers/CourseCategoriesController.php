<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseCategory;

class CourseCategoriesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

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

      return redirect('cpanel/courses_categories')
        ->with('message', 'Category Added!');
    }

    public function edit($id)
    {
      // select * from courses_categories where id  = $id
      $category = CourseCategory::find($id);
      if(!$category) {
        abort(404);
      }
      return view('admin.courses_categories.edit' , [
        'data' => $category
      ]);
    }

    public function update(Request $request)
    {
      $id = $request->get('id');
      $name = $request->get('name');

      // update courses_categories set name = $name where id = $id
      $category = CourseCategory::find($id);

      // check if name is updated
      if($category->name != $name) {
        $category->name = $name;
        $category->save();
        return redirect('cpanel/courses_categories')
          ->with('message', 'Category Updated!!');
      } else {
        return redirect('cpanel/courses_categories')
          ->with('message', 'Nothing to update!!');
      }
    }

    public function delete(Request $request)
    {
      CourseCategory::destroy($request->get('cat_id'));

      return response()->json([
          'success' => true,
          'message' => 'Category Deleted'
      ]);
    }
}
