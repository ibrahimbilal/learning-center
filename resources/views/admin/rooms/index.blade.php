@extends('layouts.app')

@section('content')
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Rooms</h1>
              <a class="btn btn-success float-right" href="{{Route('add_rooms')}}">Create Room</a>
            </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Rooms
                </div>
                <div class="card-body">
                  @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                     </div>
                  @endif
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Room Code</th>
                        <th>Capacity</th>
                        <th>Has Monitor</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $value)
                    <tr id="rooms_{{ $value->id }}">
                      <td>
                        {{ $value->id }}
                      </td>
                      <td>
                        {{ $value->code }}
                      </td>
                      <td>
                        {{ $value->capacity }}
                      </td>
                      <td>
                        {{ $value->has_monitor }}
                      </td>
                      <td>
                          <a class="btn btn-info" href="{{ Route('edit_rooms', ['id'=> $value->id]) }}">Edit</a>
                          <button type="button" class="btn btn-danger" onclick="deleteRoom( {{$value->id}} )">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
   <script>
     function deleteRoom(RoomId) {
       var result = window.confirm('are you sure you want to delete?');
       if(result) {
         $.ajax(
           {
              type: "POST",
              url: "{{route('delete_rooms')}}",
              data: {id: RoomId, _token: '{{ csrf_token() }}'},
              datatype: "json",
              success: function(response)
              {
                if(response.success) {

                  alert(response.message);
                  $('#rooms_'+RoomId).remove();
                }
              }
            }
         );
       }
     }
   </script>
@endsection
