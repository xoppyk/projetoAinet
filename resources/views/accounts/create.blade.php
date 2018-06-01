@extends('layouts.master')

@section('title', 'Create Account')
@section('content')

        <form class="form-horizontal" role="form" method="POST" >
            @csrf

			<div class="row">

    			<div class="col col-lg-9 personal-info">

                {{-- Description --}}

        			<div class="form-group">
        	            <label class="col-lg-3 control-label">Description: </label>
        	            <div class="col-lg-8">
        	                <input class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" type="text" name="description" value="{{ old('description') }}">
        	                @if ($errors->has('description'))
        	                    <div class="invalid-feedback">
        	                        {{ $errors->first('description') }}
        	                    </div>
        	                @endif
        	            </div>
        	      	</div>

                {{-- Code --}}

        			<div class="form-group">
        	            <label class="col-lg-3 control-label">Code: </label>
        	            <div class="col-lg-8">
        	                <input class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" type="text" name="code" value="{{ old('code') }}">
        	                @if ($errors->has('code'))
        	                    <div class="invalid-feedback">
        	                        {{ $errors->first('code') }}
        	                    </div>
        	                @endif
        	            </div>
        	      	</div>



                    {{-- Account Type --}}

                        <div class="form-group">
                        <label class="col-lg-3 control-label">Account type: </label>
                            <div class="col-md-8">
                                <select name="account_type_id" class="form-control">
                                    <option disabled selected> -- select a account type -- </option>
                                    @foreach ($accountTypes as $accountType)
                                        <option value="{{$accountType->id}}" {{old('account_id') == $accountType->id ? 'selected' : ''}}>{{$accountType->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('account_id'))
                                    <small class="text-danger">
                                        {{ $errors->first('account_id') }}
                                    </small>
                                @endif
                            </div>
                        </div>

        			{{-- Start Balance --}}

              		<div class="form-group">
        	            <label class="col-lg-3 control-label">Start Balance:</label>
        	            <div class="col-lg-8">
        	                <input class="form-control {{$errors->has('start_balance') ? 'is-invalid' : ''}}" type="text" name="start_balance" value="{{ old('start_balance') }}">
        	                @if ($errors->has('start_balance'))
        	                    <div class="invalid-feedback">
        	                        {{ $errors->first('start_balance') }}
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
        		          <a href="{{ route('me.editPassword') }}" class="btn btn-success">Create Account</a>
        		        </div>
              		</div>
    			</div>
    		</div>
        </form>
@endsection
