@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Add Student Session
                </div>
                <?php if(Session('message')) { ?>
                  <div class="alert alert-danger">
                      {{ Session('message') }}
                  </div>
                <?php } ?>
                <div class="card-body">
                    <form
                      method="post"
                      action="{{route('create_student_session')}}"
                    >
                      @csrf
                      <div class="form-group">
                        <label for="NameInput">Student</label>
                        <select class="form-control chosen" name="student_id">
                          @foreach ($students as $value)
                            <option value="{{$value->id}}">{{$value->full_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="NameInput">Session</label>
                        <select class="form-control chosen" name="session_id">
                          @foreach ($sessions as $value)
                            <option value="{{$value->id}}">{{$value->code}}</option>
                          @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary float-right">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
