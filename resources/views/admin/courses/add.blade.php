@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Add Course
                </div>

                <div class="card-body">
                    <form
                      method="post"
                      action="{{route('create_course')}}"
                      enctype="multipart/form-data"
                    >
                      @csrf
                      <div class="form-group">
                        <label for="NameInput">Course Name</label>
                        <input type="text" class="form-control" id="NameInput" name="name">
                      </div>
                      <div class="form-group">
                        <label for="DInput">Description</label>
                        <textarea type="text" class="form-control" id="DInput" name="description">
                        </textarea>
                      </div>
                      <div class="form-group">
                        <label for="CInput">Category</label>
                        <select class="form-control" name="category_id">
                          @foreach ($categories as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image_path" class="form-control" />
                      </div>
                      <button type="submit" class="btn btn-primary float-right">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
