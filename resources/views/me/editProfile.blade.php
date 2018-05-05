@extends('layouts.master')

@section('title', 'Edit Profile')
@section('content')
    {{-- <h1>Edit Profile</h1> --}}
  	{{-- <hr> --}}
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="{{Storage::url('profiles/'.$user->profile_photo)}}" class="img-thumbnail rounded-circle" alt="avatar">
          <img src="glyphicon glyphicon-user" class="glyphicon glyphicon-user" alt="avatar">
          <h6>Upload a different photo...</h6>

          <input type="file" class="form-control" name="profile_photo">

        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Personal info</h3>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('me.updateProfile', $user) }}">
            @csrf
            @method('patch')
          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
                <input class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" type="text" name="name" value="{{ old('name', $user->name) }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
                <input class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" type="text" name="email" value="{{ old('email', $user->email) }}">
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
                <input class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                @if ($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
              <a href="{{ route('me.editPassword') }}" class="btn btn-success">Change Password</a>
            </div>
          </div>
        </form>
      </div>
  </div>
@endsection
