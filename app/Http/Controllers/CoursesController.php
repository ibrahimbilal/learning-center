<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\CourseCategory;

class CoursesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('admin.courses.index' , [
        'data' => Course::all()
      ]);
    }

    public function add()
    {
      return view('admin.courses.add',[
        'categories' => CourseCategory::all()
      ]);
    }

    public function create(Request $request)
    {
      $c = new Course;
      $c->name = $request->get('name');
      $c->description = $request->get('description');
      $c->category_id = $request->get('category_id');

      if ($request->hasFile('image_path')) {
        $path = $request->image_path->store('courses');
        $c->image_path = 'uploads/'.$path;
      }

      $c->save();

      return redirect('cpanel/courses')
        ->with('message', 'Course Added!');
    }

    public function edit($id)
    {
      // select * from courses where id  = $id
      $course = Course::find($id);
      if(!$course) {
        abort(404);
      }
      return view('admin.courses.edit' , [
        'data' => $course,
        'categories' => CourseCategory::all()
      ]);
    }

    public function update(Request $request)
    {
      $id = $request->get('id');
      $name = $request->get('name');
      $course = Course::find($id);

      // check if data is updated
      if( $course->name != $name ||
          $course->description != $request->get('description') ||
          $course->category_id != $request->get('category_id') ||
          $request->hasFile('image_path')
        ) {
        $course->name = $name;
        $course->description = $request->get('description');
        $course->category_id = $request->get('category_id');

        if ($request->hasFile('image_path')) {
          $path = $request->image_path->store('courses');
          $course->image_path = 'uploads/'.$path;
        }
        $course->save();
        return redirect('cpanel/courses')
          ->with('message', 'Course Updated!!');
      } else {
        return redirect('cpanel/courses')
          ->with('message', 'Nothing to update!!');
      }
    }

    public function delete(Request $request)
    {
      Course::destroy($request->get('row_id'));

      return response()->json([
          'success' => true,
          'message' => 'Course Deleted'
      ]);
    }
}
