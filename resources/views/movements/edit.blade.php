@extends('layouts.master')

@section('title', 'Add Movement')
@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{route('movements.update', $movement)}}">
        @csrf
        @method('put')
		<div class="row">
			<div class="col col-lg-9 personal-info">

                {{-- Type --}}

                <div class="form-group">
                    <label class="col-lg-3 control-label">Type: </label>
                    <div class="col-md-8">
                        <select name="type" class="form-control">
                            <option disabled selected> -- select a type -- </option>
                                <option value="revenue" {{is_selected(old('type', $movement->type), 'revenue')}}>Revenue</option>
                                <option value="expense" {{is_selected(old('type', $movement->type), 'expense')}}>Expense</option>
                        </select>
                        @if ($errors->has('type'))
                            <small class="text-danger">
                                {{ $errors->first('type') }}
                            </small>
                        @endif
                    </div>
                </div>


                {{-- Movement Categoty --}}

                <div class="form-group">
                <label class="col-lg-3 control-label">Movement Categorie: </label>
                    <div class="col-md-8">
                        <select name="movement_category_id" class="form-control">
                            <option disabled selected> -- select a movement type -- </option>
                            @foreach ($movementCategories as $movementCategorie)
                                <option value="{{$movementCategorie->id}}" {{is_selected(old('movement_category_id', $movement->movement_category_id), $movementCategorie->id)}}>{{$movementCategorie->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('movement_category_id'))
                            <small class="text-danger">
                                {{ $errors->first('movement_category_id') }}
                            </small>
                        @endif
                    </div>
                </div>

                {{-- Created Date --}}

                <div class="form-group">
                    <label class="col-lg-3 control-label">Date: </label>
                    <div class="col-lg-8" id="sandbox-container">
                        <input type="text" class="form-control" name="date" value="{{old('date', $movement->date)}}" autocomplete="off">
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

    			{{-- Value--}}

          		<div class="form-group">
    	            <label class="col-lg-3 control-label">Value:</label>
    	            <div class="col-lg-8">
    	                <input class="form-control {{$errors->has('value') ? 'is-invalid' : ''}}" type="text" name="value" value="{{ old('value', $movement->value) }}">
                        @if ($errors->has('value'))
                            <small class="text-danger">
                                {{ $errors->first('value') }}
                            </small>
                        @endif
    	            </div>
          		</div>

                {{-- Description --}}

    			<div class="form-group">
    	            <label class="col-lg-3 control-label">Description: </label>
    	            <div class="col-lg-8">
    	                <input class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" type="text" name="description" value="{{ old('description', $movement->description) }}">
    	                @if ($errors->has('description'))
    	                    <div class="invalid-feedback">
    	                        {{ $errors->first('description') }}
    	                    </div>
    	                @endif
    	            </div>
    	      	</div>

          		<div class="form-group">
    		        <label class="col-md-3 control-label"></label>
    		        <div class="col-md-8">
    		          <input type="submit" class="btn btn-primary" value="Save Movement">
    		          <span></span>
    		          <a href="{{ redirect()->back() }}" class="btn btn-secondary">Cancel</a>
    		        </div>
          		</div>
			</div>
		</div>
    </form>
@endsection
