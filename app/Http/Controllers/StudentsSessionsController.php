<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Session;
use App\StudentSession;

class StudentsSessionsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('admin.students_sessions.index' , [
        'data' => StudentSession::all()
      ]);
    }

    public function add()
    {
      return view('admin.students_sessions.add',[
        'students' => Student::all(),
        'sessions' => Session::all()
      ]);
    }

    public function create(Request $request)
    {
      $data = $request->all();

      $session_id = $request->get('session_id');
      $student_id = $request->get('student_id');


      $data = StudentSession::where('session_id', $session_id)->where('student_id', $student_id)->get();
      if(count($data) > 0) {
          return redirect(Route('add_student_session'))
            ->with('message', 'Student Session already exsits!')
            ->withInput();
      }

      $c = new StudentSession;
      $c->student_id = $request->get('student_id');
      $c->session_id = $request->get('session_id');
      $c->save();

      return redirect('cpanel/students_sessions')
        ->with('message', 'Student Session Added!');
    }

    public function delete(Request $request)
    {
      StudentSession::destroy($request->get('row_id'));

      return response()->json([
          'success' => true,
          'message' => 'Student Session Deleted'
      ]);
    }
}
