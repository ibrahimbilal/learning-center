<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Teacher;
use App\Room;
use App\Course;
use DB;
use Validator;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sessions.index' ,[
          'data' => Session::all()
        ]);
    }

    public function add()
    {
      return view('admin.sessions.add', [
        'teacher' => Teacher::all(),
        'course' => Course::all(),
        'room' => Room::all()
      ]);
    }
       public function create(Request $request)
       {
          $data = $request->all();
          $validator = Validator::make($data, [
            'code' => 'required',
            'course_id' => 'required',
            'teacher_id' => 'required',
            'room_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
          ]);

          if ($validator->fails()) {
            // stop and return errors
            return redirect(Route('add_sessions'))
              ->withErrors($validator)
              ->withInput();
          }
         $session = new Session;
         $session->code = $request->get('code');
         $session->course_id = $request->get('course_id');
         $session->teacher_id = $request->get('teacher_id');
         $session->room_id = $request->get('room_id');
         $session->start_date = $request->get('start_date');
         $session->end_date = $request->get('end_date');
         $session->save();

          return redirect('cpanel/sessions')->with('status', 'Session Added!');
       }

        public function edit($id)
        {
            $session = Session::find($id);
            if(!$session) {
              abort(404);
            }
            return view('admin.sessions.edit', [
              'session' => $session,
              'teacher' => Teacher::all(),
              'course' => Course::all(),
              'room' => Room::all()
              ]);
        }

    public function delete(Request $request)
    {
      $id = $request->get('id');
        Session::destroy($id);
          return response()->json([
                'success' => true,
                'message' => 'Session Deleted'
            ]);
    }
}
