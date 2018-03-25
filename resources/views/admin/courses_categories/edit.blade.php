@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Edit Course Category
                </div>

                <div class="card-body">
                    <form
                      method="post"
                      action="/cpanel/courses_categories/update"
                    >
                      @csrf
                      <input type="hidden" name="id" value="{{$data->id}}" />
                      <div class="form-group">
                        <label for="NameInput">Category Name</label>
                        <input type="text" class="form-control" id="NameInput" name="name" value="{{$data->name}}">
                      </div>
                      <button type="submit" class="btn btn-primary float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
