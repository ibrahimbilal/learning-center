@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Courses
                  <a
                    href="{{route('add_course')}}"
                    class="btn btn-sm btn-success float-right"
                  >Add Course</a>
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
                        <th>Action</th>
                      </tr>
                      @foreach ($data as $value)
                      <tr row_id="{{$value->id}}">
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                          <a href="/cpanel/courses/edit/{{$value->id}}" class="btn btn-sm btn-info">
                            Edit
                          </a>
                          <button class="btn btn-sm btn-danger" onclick="deleteCourse({{$value->id}})">
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
function deleteCourse(id) {
  console.log(id);
  $.ajax({
      type: 'post',
      url: '/cpanel/courses/delete',
      data: {
        row_id: id,
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
