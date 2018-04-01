<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use DB;
use Validator;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('admin.teachers.index' ,[
            'data' => Teacher::all()
          ]);
    }

    public function add()
    {
      return view('admin.teachers.add', [
        'data' => Teacher::all()
      ]);
    }

       public function create(Request $request)
       {
          $data = $request->all();
          $validator = Validator::make($data, [
            'full_name' => 'required|min:5',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'gender' => 'required',
            'year_of_exp' => 'required ',
            'birth_day' => 'required|date ',
            'join_date' => 'required|date ',
          ]);

          if ($validator->fails()) {
            // stop and return errors
            return redirect(Route('add_teachers'))
              ->withErrors($validator)
              ->withInput();
          }
         $teacher = new Teacher;
         $teacher->full_name = $request->get('full_name');
         $teacher->email = $request->get('email');
         $teacher->phone = $request->get('phone');
         $teacher->address = $request->get('address');
         $teacher->gender = $request->get('gender');
         $teacher->year_of_exp = $request->get('year_of_exp');
         $teacher->birth_day = $request->get('birth_day');
         $teacher->join_date = $request->get('join_date');

         $teacher->save();

          return redirect('cpanel/teachers')->with('status', 'Teacher Added!');
       }

       public function edit($id)
       {
               $teacher = Teacher::find($id);
               if(!$teacher) {
                 abort(404);
               }
                 return view('admin.teachers.edit', [
                   'teacher' => $teacher,
                   'data' => Teacher::all()
                 ]);
       }

   public function update(Request $request)
   {
       $data = $request->all();
       $validator = Validator::make($data, [
           'full_name' => 'required|min:5',
           'email' => 'required|email',
           'phone' => 'required|numeric',
           'address' => 'required',
           'gender' => 'required',
           'year_of_exp' => 'required ',
           'birth_day' => 'required|date ',
           'join_date' => 'required|date ',
       ]);

       if ($validator->fails()) {
         // stop and return errors
         return redirect(Route('add_teachers'))
           ->withErrors($validator)
           ->withInput();
       }

      $id = $request->get('id');
      $full_name = $request->get('full_name');
      $email = $request->get('email');
      $phone = $request->get('phone');
      $address = $request->get('address');
      $gender = $request->get('gender');
      $year_of_exp = $request->get('year_of_exp');
      $birth_day = $request->get('birth_day');
      $join_date = $request->get('join_date');

        $teacher= Teacher::find($id);
        // dd($teacher);
          if($teacher->full_name != $full_name ||
             $teacher->email != $email ||
             $teacher->phone != $phone ||
             $teacher->address != $address ||
             $teacher->gender != $gender ||
             $teacher->year_of_exp != $year_of_exp ||
             $teacher->birth_day != $birth_day ||
             $teacher->join_date != $join_date
           ) {

            $teacher->full_name = $full_name;
            $teacher->email = $email;
            $teacher->phone = $phone;
            $teacher->address = $address;
            $teacher->gender = $gender;
            $teacher->year_of_exp = $year_of_exp;
            $teacher->birth_day = $birth_day;
            $teacher->join_date = $join_date;

        $teacher->save();
        return redirect('cpanel/teachers')->with('status', 'Teacher Updated!');
      }else {
        return redirect('cpanel/teachers')->with('status', 'Nothing To Update');
      }
    }

    public function delete(Request $request)
    {
      $id = $request->get('id');
        Teacher::destroy($id);
          return response()->json([
                'success' => true,
                'message' => 'Teacher Deleted'
            ]);
    }

}
