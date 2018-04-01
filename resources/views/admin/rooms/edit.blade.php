@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Room</div>
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
                  <form method="post" action="{{Route('update_rooms')}}"> @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <label for="room_code">Room Code</label>
                    <input class="form-control" id="room_code" type="text" placeholder="The Room Code" name="code" value="{{ $data->code }}" value="{{old('code')}}">
                    <label for="room_capacity">Capacity</label>
                    <input class="form-control" id="room_capacity" type="number" min="0" placeholder="The Room Capacity" value="{{ $data->capacity }}" name="capacity" value="{{old('capacity')}}">
                    <label for="room_mon">Has Monitor</label>
                    <input class="form-control" id="room_mon" type="number" min="0" placeholder="The Room Monitor" value="{{ $data->has_monitor }}" name="has_monitor" value="{{old('has_monitor')}}">
                    <br>
                    <input type="submit" class="btn btn-primary float-right" value="Update">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
