@extends('layouts.app')

@section('content')
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Students</h1>
              <a class="btn btn-success float-right" href="{{Route('add_students')}}">Add Students</a>
            </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Students
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
                        <th>{{__('students.full_name')}}</th>
                        <th>{{__('students.email')}}</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Education LVL</th>
                        <th>intresets</th>
                        <th>Birth Day</th>
                        <th>Gender</th>
                        <th>Registration Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $value)
                      <tr id="students_{{ $value->id }}">
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
                          {{ $value->edu_lvl }}
                        </td>
                        <td>
                           {{ $value->intresets }}
                         </td>
                        <td>
                          {{ $value->birth_day }}
                        </td>
                        <td>
                          {{ $value->gender }}
                        </td>
                        <td>
                          {{ $value->reg_date }}
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ Route('edit_students', ['id'=> $value->id]) }}">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="deleteStudent( {{$value->id}} )">Delete</a>
                            <button type="button" class="btn btn-sky" onclick="viewStudent( {{$value->id}} )">View</a>
                        </td>
                      </tr>
                      <!--  -->
                      @endforeach
                      @if (count($data) == 0)
                      <tr>
                        <td class="text-center" colspan="100%">No data</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="student_details_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Email
        <p id="modal_email"></p>
        Phone
        <p id="modal_phone"></p>
        Address
        <p id="modal_address"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

   <script>
     function deleteStudent(StudentId) {
       var result = window.confirm('are you sure you want to delete?');
       if(result) {
         $.ajax(
           {
              type: "POST",
              url: "{{route('delete_students')}}",
              data: {id: StudentId, _token: '{{ csrf_token() }}'},
              datatype: "json",
              success: function(response)
              {
                 if(response.success) {
                   alert(response.message);
                   $('#students_'+StudentId).remove();
                 }
              }
            }
         );
       }
     }

     function viewStudent(id) {
       $.ajax(
         {
            type: "POST",
            url: "{{route('view_students')}}",
            data: {id: id, _token: '{{ csrf_token() }}'},
            datatype: "json",
            success: function(response)
            {
               console.log(response);
               $('#modal_header').html(response.data.full_name);
               $('#modal_email').html(response.data.email);
               $('#modal_phone').html(response.data.phone);
               $('#modal_address').html(response.data.address);

               $('#student_details_modal').modal();
            }
          }
       );
     }
   </script>
@endsection
