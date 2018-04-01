@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Session</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                    @endif
                   <div class="card-body">
                     <form method="post" action="{{Route('update_students')}}"> @csrf
                       <div class="form-group">
                         <label for="code">Session Code</label>
                         <input type="hidden" name="id" value="{{$session->id}}" />
                         <input class="form-control" id="code" type="text" placeholder="Enter The Session Code" name="code" value="{{ $session->code }}" value="{{old('code')}}">
                       </div>
                       <div class="form-group">
                         <label for="code">Courses</label>
                         <select class="form-control" id="cat" name="course_id" value="{{$session->course_id}}">
                         @foreach ($course as $value)
                          <?php
                          $selected = '';
                          if ($session->course_id == $value->id) {
                            $selected = 'selected="selected"';
                          } ?>
                           <option value="{{ $value->id}}" {{$selected}}>{{ $value->name }}</option>
                         @endforeach
                         </select>
                       </div>
                       <div class="row">
                         <div class="form-group col-md-6">
                           <label for="code">Teachers</label>
                           <select class="form-control" id="cat" name="teacher_id" value="{{$session->teacher_id}}">
                             @foreach ($teacher as $value)
                              <?php
                              $selected = '';
                              if ($session->teacher_id == $value->id) {
                                $selected = 'selected="selected"';
                              } ?>
                               <option value="{{ $value->id}}" {{$selected}}>{{ $value->full_name }}</option>
                             @endforeach
                           </select>
                         </div>
                         <div class="form-group col-md-6">
                           <label for="code">Rooms</label>
                           <select class="form-control" id="cat" name="room_id" value="{{$session->room_id}}">
                             @foreach ($room as $value)
                              <?php
                              $selected = '';
                              if ($session->room_id == $value->id) {
                                $selected = 'selected="selected"';
                              } ?>
                               <option value="{{ $value->id}}" {{$selected}}>{{ $value->code }}</option>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group col-md-6">
                           <label for="code">Start Date</label>
                           <input class="form-control" id="code" type="date" name="start_date" value="{{$session->start_date}}" value="{{old('start_date')}}">
                         </div>
                         <div class="form-group col-md-6">
                           <label for="code">End Date</label>
                           <input class="form-control" id="code" type="date" name="end_date" value="{{$session->end_date}}" value="{{old('end_date')}}">
                         </div>
                       </div>
                    <br>
                    <input type="submit" class="btn btn-primary float-right" value="Update">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
