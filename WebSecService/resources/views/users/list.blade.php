@extends('layouts.master')
@section('title', 'Users')
@section('content')
<div class="row mt-2">
    <div class="col col-10">
        <h1>Users</h1>
    </div>
</div>
<form>
    <div class="row">
        <div class="col col-sm-2">
            <input name="keywords" type="text"  class="form-control" placeholder="Search Keywords" value="{{ request()->keywords }}" />
        </div>
        <div class="col col-sm-1">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col col-sm-1">
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
        @if(auth()->user()->hasRole('Admin'))
        <div class="col col-sm-1">
            <a href="{{ route('user_add') }}" class="btn btn-success">Add</a>
        </div>
        @endif
    </div>
</form>

<div class="card mt-2">
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Roles</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      @foreach($users as $user)
      <tr>
        <td scope="col">{{$user->id}}</td>
        <td scope="col">{{$user->name}}</td>
        <td scope="col">{{$user->email}}</td>
        <td scope="col">
          @foreach($user->roles as $role)
            <span class="badge bg-primary">{{$role->name}}</span>
          @endforeach
        </td>
        <td scope="col">
          @if(auth()->user()->hasRole('Admin'))
            <a class="btn btn-primary" href='{{route('users_edit', [$user->id])}}'>Edit</a>
            <a class="btn btn-primary" href='{{route('edit_password', [$user->id])}}'>Change Password</a>
            <a class="btn btn-primary" href='{{route('credit', [$user->id])}}'>Credit</a>
            <a class="btn btn-danger" href='{{route('users_delete', [$user->id])}}'>Delete</a>
            


          @elseif(auth()->user()->hasRole('Employee'))
            <a class="btn btn-primary" href='{{route('edit_password', [$user->id])}}'>Change Password</a>
            <a class="btn btn-primary" href='{{route('credit', [$user->id])}}'>Credit</a>

          @endif
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>


@endsection
