@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Add Course Category
                </div>

                <div class="card-body">
                    <form
                      method="post"
                      action="{{route('create_course_category')}}"
                    >
                      @csrf
                      <div class="form-group">
                        <label for="NameInput">Category Name</label>
                        <input type="text" class="form-control" id="NameInput" name="name">
                      </div>
                      <button type="submit" class="btn btn-primary float-right">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
