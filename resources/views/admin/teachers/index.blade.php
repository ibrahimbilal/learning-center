@extends('layouts.app')

@section('content')
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Teachers</h1>
              <a class="btn btn-success float-right" href="{{Route('add_teachers')}}">Add Teachers</a>
            </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Teachers
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
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Year Of Exp</th>
                        <th>Birth Day</th>
                        <th>Gender</th>
                        <th>Join Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $value)
                      <tr id="teachers_{{ $value->id }}">
                        <td>
                          {{ $value->id }}
                        </td>
                        <td>
                          {{ $value->full_name }}
                        </td>
                        <td>
                          {{ $value->email }}
                        </td>
                        <td>
                          {{ $value->phone }}
                        </td>
                        <td>
                          {{ $value->address }}
                        </td>
                        <td>
                          {{ $value->year_of_exp }}
                        </td>
                        <td>
                          {{ $value->birth_day }}
                        </td>
                        <td>
                          {{ $value->gender }}
                        </td>
                        <td>
                          {{ $value->join_date }}
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ Route('edit_teachers', ['id'=> $value->id]) }}">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="deleteTeacher( {{$value->id}} )">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                      <!-- <tr>
                        <td class="text-center" colspan="10">No data</td>
                      </tr> -->
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
   <script>
     function deleteTeacher(TeacherId) {
       var result = window.confirm('are you sure you want to delete?');
       if(result) {
         $.ajax(
           {
              type: "POST",
              url: "{{route('delete_teachers')}}",
              data: {id: TeacherId, _token: '{{ csrf_token() }}'},
              datatype: "json",
              success: function(response)
              {
                 if(response.success) {
                   alert(response.message);
                   $('#teachers_'+TeacherId).remove();
                 }
              }
            }
         );
       }
     }
   </script>
@endsection
