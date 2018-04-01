@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Room</div>
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
                  <form method="post" action="{{Route('create_rooms')}}"> @csrf
                    <label for="cat">Room Code</label>
                    <input class="form-control" id="cat" type="text" placeholder="The Room Code" name="code" value="{{old('code')}}">
                    <label for="cat">Capacity</label>
                    <input class="form-control" id="cat" type="number" min="0" placeholder="The Room Capacity" name="capacity" value="{{old('capacity')}}">
                    <label for="cat">Has Monitor</label>
                    <input class="form-control" id="cat" type="number" min="0" placeholder="The Room Monitor" name="has_monitor" value="{{old('has_monitor')}}">
                    <br>
                    <input type="submit" class="btn btn-primary float-right" value="Create">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
