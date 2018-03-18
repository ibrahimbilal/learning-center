@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Courses Categories
                  <a
                    href="{{route('add_course_category')}}"
                    class="btn btn-sm btn-success float-right"
                  >Add Course Category</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($data as $value)
                      <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                          <a href="admin/courses_categories/edit/{{$value->id}}" class="btn btn-sm btn-info">
                            Edit
                          </a>
                          <button class="btn btn-sm btn-danger">
                            Delete
                          </button>
                        </td>
                      </tr>
                      @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
