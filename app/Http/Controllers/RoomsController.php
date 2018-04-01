<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use DB;
use Validator;

class RoomsController extends Controller
{
     public function index()
     {
         return view('admin.rooms.index' , [
           'data' => Room::all()
         ]);
     }

     public function add()
     {
       return view('admin.rooms.add');
     }

     public function create(Request $request)
     {
        $data = $request->all();
        $validator = Validator::make($data, [
          'code' => 'required',
          'capacity' => 'required',
          'has_monitor' => 'required',
        ]);

        if ($validator->fails()) {
          // stop and return errors
          return redirect(Route('add_rooms'))
            ->withErrors($validator)
            ->withInput();
        }
       $room = new Room;
       $room->code = $request->get('code');
       $room->capacity = $request->get('capacity');
       $room->has_monitor = $request->get('has_monitor');
       $room->save();


        return redirect('cpanel/rooms')->with('status', 'Room Added!');
     }

     public function edit($id)
     {
           $room = Room::find($id);
           if(!$room) {
             abort(404);
           }
             return view('admin.rooms.edit', [
               'data' => $room
             ]);
     }

     public function update(Request $request)
     {
        $data = $request->all();
        $validator = Validator::make($data, [
          'code' => 'required',
          'capacity' => 'required',
          'has_monitor' => 'required',
        ]);

        if ($validator->fails()) {
          // stop and return errors
          return redirect(Route('add_rooms'))
            ->withErrors($validator)
            ->withInput();
        }
       // dd($request->all());
       $id = $request->get('id');
       $code = $request->get('code');
       $capacity = $request->get('capacity');
       $has_monitor = $request->get('has_monitor');

        $room = Room::find($id);
        if($room->code != $code ||
           $room->capacity != $capacity ||
           $room->has_monitor != $has_monitor
          ){
        $room->code = $code;
        $room->capacity = $capacity;
        $room->has_monitor = $has_monitor;
        $room->save();

        return redirect('cpanel/rooms')->with('status', 'Room Updated!');
      }else {
        return redirect('cpanel/rooms')->with('status', 'Nothing To Update');
      }

     }
     public function delete(Request $request)
     {
       $id = $request->get('id');
         Room::destroy($id);
         return response()->json([
               'success' => true,
               'message' => 'Room Deleted'
           ]);
     }

}
