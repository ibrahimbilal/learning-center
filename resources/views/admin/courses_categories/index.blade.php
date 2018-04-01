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
                <?php if(Session('message')) { ?>
                  <div class="alert alert-success">
                      {{ Session('message') }}
                  </div>
                <?php } ?>
                <div class="card-body">
                    <table class="table table-bordered">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Courses</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($data as $value)
                      <tr row_id="{{$value->id}}">
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                          @foreach ($value->courses as $key => $value)
                            {{ $value->name }}
                          @endforeach
                        </td>
                        <td>
                          <a href="/cpanel/courses_categories/edit/{{$value->id}}" class="btn btn-sm btn-info">
                            Edit
                          </a>
                          <button class="btn btn-sm btn-danger" onclick="deleteCategory({{$value->id}})">
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
<script>
function deleteCategory(id) {
  console.log(id);
  $.ajax({
      type: 'post',
      url: '/cpanel/courses_categories/delete',
      data: {
        cat_id: id,
        _token: '{{ csrf_token() }}'
      },
      dataType: 'json',
      success: function(response) {
        if(response.success) {
          alert(response.message);
          $('[row_id="'+id+'"]').remove();
        }
      }
  });
}
</script>
@endsection
