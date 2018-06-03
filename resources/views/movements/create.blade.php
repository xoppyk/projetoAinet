@extends('layouts.master')

@section('title', 'Add Movement')
@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{route('movements.store', $account)}}">
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

                {{-- Type --}}

                <div class="form-group">
                    <label class="col-lg-3 control-label">Type: </label>
                    <div class="col-md-8">
                        <select name="account_type_id" class="form-control">
                            <option disabled selected> -- select a type -- </option>
                                <option value="revenue" >Revenue</option>
                                <option value="expense" >Expense</option>
                        </select>
                        @if ($errors->has('account_type_id'))
                            <small class="text-danger">
                                {{ $errors->first('account_type_id') }}
                            </small>
                        @endif
                    </div>
                </div>


                {{-- Movement Categoty --}}

                <div class="form-group">
                <label class="col-lg-3 control-label">Movement Categorie: </label>
                    <div class="col-md-8">
                        <select name="account_type_id" class="form-control">
                            <option disabled selected> -- select a movement type -- </option>
                            @foreach ($movementCategories as $movementCategorie)
                                <option value="{{$movementCategorie->id}}" {{old('account_type_id') == $movementCategorie->id ? 'selected' : ''}}>{{$movementCategorie->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('account_type_id'))
                            <small class="text-danger">
                                {{ $errors->first('account_type_id') }}
                            </small>
                        @endif
                    </div>
                </div>

                {{-- Created Date --}}

                <div class="form-group">
                    <label class="col-lg-3 control-label">Date: </label>
                    <div class="col-lg-8" id="sandbox-container">
                        <input type="text" class="form-control" name="date" value="{{old('date')}}" autocomplete="off">
                    </div>
                    <script type="text/javascript">
                        $('#sandbox-container input').datepicker({
                            format: "yyyy/mm/dd"
                        });
                    </script>
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                </div>
                
    			{{-- Value--}}

          		<div class="form-group">
    	            <label class="col-lg-3 control-label">Value:</label>
    	            <div class="col-lg-8">
    	                <input class="form-control {{$errors->has('value') ? 'is-invalid' : ''}}" type="text" name="value" value="{{ old('value', '0.00') }}">
    	                @if ($errors->has('value'))
    	                    <div class="invalid-feedback">
    	                        {{ $errors->first('value') }}
    	                    </div>
    	                @endif
    	            </div>
          		</div>

          		<div class="form-group">
    		        <label class="col-md-3 control-label"></label>
    		        <div class="col-md-8">
    		          <input type="submit" class="btn btn-primary" value="Create Account">
    		          <span></span>
    		          <a href="{{ redirect()->back() }}" class="btn btn-secondary">Cancel</a>
    		        </div>
          		</div>
			</div>
		</div>
    </form>
@endsection
