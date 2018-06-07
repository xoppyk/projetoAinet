@extends('layouts.master')

@section('title', 'Upload Document')
@section('content')
        <form class="form-horizontal" role="form" method="POST" action="{{route('documents.store', $movement->id)}}" enctype="multipart/form-data">
            @csrf
    			<div class="col col-lg-9 personal-info">

                    {{-- Document File --}}

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Document File: </label>
                        <div class="col-lg-8">
                            <input class="form-control {{$errors->has('document_file') ? 'is-invalid' : ''}}" type="file" name="document_file">
                            @if ($errors->has('document_file'))
                                <small class="invalid-feedback">
                                    {{ $errors->first('document_file') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    {{-- Document Description --}}

        			<div class="form-group">
        	            <label class="col-lg-3 control-label">Document Description: </label>
        	            <div class="col-lg-8">
        	                <input class="form-control {{$errors->has('document_description') ? 'is-invalid' : ''}}" type="text" name="document_description" value="{{ old('document_description') }}">
        	                @if ($errors->has('document_description'))
        	                    <small class="invalid-feedback">
        	                        {{ $errors->first('document_description') }}
        	                    </small>
        	                @endif
        	            </div>
        	      	</div>

              		<div class="form-group">
        		        <label class="col-md-3 control-label"></label>
        		        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Upload Document">
                            <span></span>
                            <a href="{{ route('movements.index',$movement->account_id) }}" class="btn btn-secondary">Cancel</a>
        		        </div>
              		</div>
    			</div>
    		</div>
        </form>

@endsection
