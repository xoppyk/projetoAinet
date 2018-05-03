@extends('layouts.master')

@section('title', 'DashBoard')
@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
    </div>
@endsection
