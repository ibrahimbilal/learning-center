@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Student</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                    @endif
                   <div class="card-body">
                     <form method="post" action="{{Route('update_students')}}"> @csrf
                       <div class="form-group">
                         <label for="name">Student Name</label>
                         <input type="hidden" name="id" value="{{$student->id}}" />
                         <input class="form-control" id="name" type="text" placeholder="Enter The Full Name" name="full_name"   value="{{$student->full_name}}" value="{{old('full_name')}}">
                       </div>
                       <div class="form-group">
                         <label for="email">E-mail</label>
                         <input class="form-control" id="email" type="text" placeholder="Enter The E-mail" name="email" value="{{$student->email}}" value="{{old('email')}}">
                       </div>
                       <div class="form-group">
                         <label for="phone">Phone Number</label>
                         <input class="form-control" id="phone" type="text" placeholder="Enter Phone Number" name="phone" value="{{$student->phone}}" value="{{old('phone')}}">
                       </div>
                       <div class="form-group">
                         <label for="address">Address</label>
                         <input class="form-control" id="address" type="text" placeholder="Enter The Address" name="address" value="{{$student->address}}" value="{{old('address')}}">
                       </div>
                        <div class="form-group">
                          <label for="address">Intresets</label>
                          <input class="form-control" id="address" type="text" placeholder="Enter The Student Intresets" name="intresets" value="{{$student->intresets}}" value="{{old('intresets')}}">
                        </div>
                       <div class="row">
                         <div class="form-group col-md-6">
                           <label for="exp">Education Level</label>
                           <input class="form-control" id="exp" type="text" placeholder="Enter The Education Level" name="edu_lvl" value="{{$student->edu_lvl}}" value="{{old('edu_lvl')}}">
                         </div>
                         <div class="form-group col-md-6">
                           <label for="gender">Gender</label>
                           <select class="form-control" id="gender" name="gender" >
                              <?php if ($student->gender == 'male'){ ?>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                              <?php }else { ?>
                                <option value="male">Male</option>
                                <option value="female" selected>Female</option>
                             <?php } ?>
                           </select>
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group col-md-6">
                           <label for="birth">Birth Day</label>
                           <input class="form-control" id="birth" type="date" name="birth_day" value="{{$student->birth_day}}" value="{{old('birth_day')}}">
                         </div>
                         <div class="form-group col-md-6">
                           <label for="Join">Registration Date</label>
                           <input class="form-control" id="Join" type="date" name="reg_date" value="{{$student->reg_date}}" value="{{old('reg_date')}}">
                         </div>
                       </div>
                    <br>
                    <input type="submit" class="btn btn-primary float-right" value="Update">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
