@extends('layouts.master')

@section('title', 'Change Password')
@section('content')
    <form class="form-control" action="{{route('me.updatePassword')}}" method="post">
        @csrf
        @method('patch')

        {{-- Old Password --}}
        <br>
        <div class="form-group">
          <label class="col-sm-5 col-form-label col-form-label-lg">Old Password:</label>
          <div class="col-lg-12">
              <input class="form-control {{$errors->has('old_password') ? 'is-invalid' : ''}}" type="password" name="old_password" value="{{ old('old_password') }}">
              @if ($errors->has('old_password'))
                  <div class="invalid-feedback">
                      {{ $errors->first('old_password') }}
                  </div>
              @endif
          </div>
        </div>

        {{-- New Password --}}

        <div class="form-group">
          <label class="col-sm-5 col-form-label col-form-label-lg">New Password:</label>
          <div class="col-lg-12">
              <input class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" type="password" name="password" value="{{ old('password') }}">
              @if ($errors->has('password'))
                  <div class="invalid-feedback">
                      {{ $errors->first('password') }}
                  </div>
              @endif
          </div>
        </div>

        {{-- Confirmation Password --}}

        <div class="form-group">
          <label class="col-sm-5 col-form-label col-form-label-lg">Confirmation Password</label>
          <div class="col-lg-12">
              <input class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" type="password" name="password_confirmation" value="{{ old('password') }}">
              @if ($errors->has('password'))
                  <div class="invalid-feedback">
                      {{ $errors->first('password') }}
                  </div>
              @endif
          </div>
        </div>

        {{-- Buttons --}}

        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="Change Password">
            <span></span>
            <a href="{{ route('me.editProfile') }}" class="btn btn-secondary">Cancel</a>
          </div>
        </div>
    </form>
@endsection
