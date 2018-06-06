@extends('layouts.master')

@section('title', 'Edit Account')
@section('content')

        <form class="form-horizontal" role="form" method="POST" action="{{route('account.update', $account)}}">
            @method('put')
            @csrf
			<div class="row">
    			<div class="col col-lg-9 personal-info">

                {{-- Description --}}

        			<div class="form-group">
        	            <label class="col-lg-3 control-label">Description: </label>
        	            <div class="col-lg-8">
        	                <input class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" type="text" name="description" value="{{ old('description', $account->description) }}">
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
        	                <input class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" type="text" name="code" value="{{ old('code', $account->code) }}">
        	                @if ($errors->has('code'))
        	                    <div class="invalid-feedback">
        	                        {{ $errors->first('code') }}
        	                    </div>
        	                @endif
        	            </div>
        	      	</div>
                    {{-- Created Date --}}

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Date: </label>
                        <div class="col-lg-8" id="sandbox-container">
                            <input type="text" class="form-control" name="date" value="{{old('date', $account->date)}}" autocomplete="off">
                            @if ($errors->has('date'))
                                <small class="text-danger">
                                    {{ $errors->first('date') }}
                                </small>
                            @endif
                        </div>
                        <script type="text/javascript">
                            $('#sandbox-container input').datepicker({
                                format: "yyyy/mm/dd"
                            });
                        </script>
                    </div>
                    
                    {{-- Account Type --}}

                        <div class="form-group">
                        <label class="col-lg-3 control-label">Account type: </label>
                            <div class="col-md-8">
                                <select name="account_type_id" class="form-control">
                                    <option disabled selected> -- select a account type -- </option>
                                    @foreach ($accountTypes as $accountType)
                                        <option value="{{$accountType->id}}" {{old('account_type_id', $account->account_type_id) == $accountType->id ? 'selected' : ''}}>{{$accountType->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('account_type_id'))
                                    <small class="text-danger">
                                        {{ $errors->first('account_type_id') }}
                                    </small>
                                @endif
                            </div>
                        </div>

        			{{-- Start Balance --}}

              		<div class="form-group">
        	            <label class="col-lg-3 control-label">Start Balance:</label>
        	            <div class="col-lg-8">
        	                <input class="form-control {{$errors->has('start_balance') ? 'is-invalid' : ''}}" type="text" name="start_balance" value="{{ old('start_balance', $account->start_balance) }}">
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
        		          <input type="submit" class="btn btn-primary" value="Save Account">
        		          <span></span>
        		          <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        		        </div>
              		</div>
    			</div>
    		</div>
        </form>
@endsection
