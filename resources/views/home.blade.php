@extends('layouts.master')

@section('title', 'Welcome')
@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        Welcome Projeto Ainet
    </div>
@endsection
