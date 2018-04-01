@extends('layouts.app')

@section('content')
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Sessions</h1>
              <a class="btn btn-success float-right" href="{{Route('add_sessions')}}">Create Sessions</a>
            </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sessions
                </div>
                <div class="card-body">
                  @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                     </div>
                  @endif
                  <table class="table table-hover ">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Course</th>
                        <th>Teacher</th>
                        <th>Room</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $value)
                      <tr id="sessions_{{ $value->id }}">
                        <td>
                          {{ $value->id }}
                        </td>
                        <td>
                          {{ $value->code }}
                        </td>
                        <td>
                          {{ $value->course->name }}
                        </td>
                        <td>
                          {{ $value->teacher->full_name }}
                        </td>
                        <td>
                          {{ $value->room->code }}
                        </td>
                        <td>
                          {{ $value->start_date }}
                        </td>
                        <td>
                           {{ $value->end_date }}
                         </td>
                        <td>
                            <a class="btn btn-info" href="{{ Route('edit_sessions', ['id'=> $value->id]) }}">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="deleteSession( {{$value->id}} )">Delete</a>
                        </td>
                      </tr>
                      <!-- <tr>
                        <td class="text-center" colspan="11">No data</td>
                      </tr> -->
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
   <script>
     function deleteSession(SessionId) {
       var result = window.confirm('are you sure you want to delete?');
       if(result) {
         $.ajax(
           {
              type: "POST",
              url: "{{route('delete_sessions')}}",
              data: {id: SessionId, _token: '{{ csrf_token() }}'},
              datatype: "json",
              success: function(response)
              {
                 if(response.success) {
                   alert(response.message);
                   $('#sessions_'+SessionId).remove();
                 }
              }
            }
         );
       }
     }
   </script>
@endsection
