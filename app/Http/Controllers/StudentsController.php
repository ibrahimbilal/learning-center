<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DB;
use Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(session('current_lang')) {
        \App::setLocale(session('current_lang'));
      }
      activity()->log('Enter Student Index');

        return view('admin.students.index' ,[
          'data' => Student::all()
        ]);
    }

    public function add()
    {
      return view('admin.students.add', [
        'data' => Student::all()
      ]);
    }

       public function create(Request $request)
       {
          $data = $request->all();
          $validator = Validator::make($data, [
            'full_name' => 'required|min:5',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'intresets' => 'required',
            'gender' => 'required',
            'edu_lvl' => 'required ',
            'birth_day' => 'required|date ',
            'reg_date' => 'required|date ',
          ]);

          if ($validator->fails()) {
            // stop and return errors
            return redirect(Route('add_students'))
              ->withErrors($validator)
              ->withInput();
          }
         $student = new Student;
         $student->full_name = $request->get('full_name');
         $student->email = $request->get('email');
         $student->phone = $request->get('phone');
         $student->address = $request->get('address');
         $student->intresets = $request->get('intresets');
         $student->gender = $request->get('gender');
         $student->edu_lvl = $request->get('edu_lvl');
         $student->birth_day = $request->get('birth_day');
         $student->reg_date = $request->get('reg_date');

         $student->save();

          return redirect('cpanel/students')->with('status', 'Student Added!');
       }

       public function edit($id)
       {
               $student = Student::find($id);
               if(!$student) {
                 abort(404);
               }
                 return view('admin.students.edit', [
                   'student' => $student,
                   'data' => Student::all()
                 ]);
       }


       public function getDetials(Request $request)
       {
         $id = $request->get('id');
         return response()->json([
               'data' => Student::find($id)
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
           'intresets' => 'required',
           'gender' => 'required',
           'edu_lvl' => 'required ',
           'birth_day' => 'required|date ',
           'reg_date' => 'required|date ',
       ]);

       if ($validator->fails()) {
         // stop and return errors
         return redirect(Route('add_students'))
           ->withErrors($validator)
           ->withInput();
       }

      $id = $request->get('id');
      $full_name = $request->get('full_name');
      $email = $request->get('email');
      $phone = $request->get('phone');
      $address = $request->get('address');
      $intresets = $request->get('intresets');
      $gender = $request->get('gender');
      $edu_lvl = $request->get('edu_lvl');
      $birth_day = $request->get('birth_day');
      $reg_date = $request->get('reg_date');

        $student= Student::find($id);

          if($student->full_name != $full_name ||
             $student->email != $email ||
             $student->phone != $phone ||
             $student->address != $address ||
             $student->intresets != $intresets ||
             $student->gender != $gender ||
             $student->edu_lvl != $edu_lvl ||
             $student->birth_day != $birth_day ||
             $student->reg_date != $reg_date
           ) {

            $student->full_name = $full_name;
            $student->email = $email;
            $student->phone = $phone;
            $student->address = $address;
            $student->intresets = $intresets;
            $student->gender = $gender;
            $student->edu_lvl = $edu_lvl;
            $student->birth_day = $birth_day;
            $student->reg_date = $reg_date;

        $student->save();
        return redirect('cpanel/students')->with('status', 'Student Updated!');
      }else {
        return redirect('cpanel/students')->with('status', 'Nothing To Update');
      }
    }

    public function delete(Request $request)
    {
      $id = $request->get('id');
        Student::destroy($id);
          return response()->json([
                'success' => true,
                'message' => 'Student Deleted'
            ]);
    }

}
