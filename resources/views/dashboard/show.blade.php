@extends('layouts.master')

@section('title', 'DashBoard')
@section('content')
    <div class="card-body">
        <label for="">Sum of All Accounts</label>
        {{$accountSum}}
    </div>
@endsection
