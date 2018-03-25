@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Edit Course
                </div>

                <div class="card-body">
                    <form
                      method="post"
                      action="/cpanel/courses/update"
                      enctype="multipart/form-data"
                    >
                      @csrf
                      <input type="hidden" name="id" value="{{$data->id}}" />
                      <div class="form-group">
                        <label for="NameInput">Course Name</label>
                        <input type="text" class="form-control" id="NameInput" name="name" value="{{$data->name}}">
                      </div>
                      <div class="form-group">
                        <label for="DInput">Description</label>
                        <textarea type="text" class="form-control" id="DInput" name="description">{{$data->description}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="CInput">Category</label>
                        <select class="form-control" name="category_id">
                          @foreach ($categories as $value)
                            <?php
                            $selected = '';
                            if($data->category_id == $value->id) {
                              $selected = 'selected="selected"';
                            }
                            ?>
                            <option value="{{$value->id}}" {{$selected}} >{{$value->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Image</label>
                        <div class="clearfix"></div>
                        <img class="img-thumbnail" src="/{{$data->image_path}}" >
                        <div class="clearfix"></div>
                        <input type="file" name="image_path" class="form-control" />
                      </div>
                      <button type="submit" class="btn btn-primary float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
