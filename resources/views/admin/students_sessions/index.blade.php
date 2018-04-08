@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Student Session
                  <a
                    href="{{route('add_student_session')}}"
                    class="btn btn-sm btn-success float-right"
                  >Add Student Session</a>
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
                        <th>Student</th>
                        <th>Session</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($data as $value)
                      <tr row_id="{{$value->id}}">
                        <td>{{$value->id}}</td>
                        <td>{{$value->hasStudent->full_name}}</td>
                        <td>{{$value->hasSession->code}}</td>
                        <td>
                          <button class="btn btn-sm btn-danger" onclick="deleteStudentSession({{$value->id}})">
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
function deleteStudentSession(id) {
  console.log(id);
  $.ajax({
      type: 'post',
      url: '/cpanel/students_sessions/delete',
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
