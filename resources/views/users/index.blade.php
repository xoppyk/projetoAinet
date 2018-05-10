@extends('layouts.master')

@section('title', 'List Of All Users')
@section('content')
    @if(count($users))
    <table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr class="{{$user->blocked ? 'table-danger' : ''}}">
            <td>{{ $user->email}}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $user->isAdmin }}</td>
            <td>{{ $user->isBlocked }}</td>
            <td>
                {{-- @can('edit', $user)
                <a class="btn btn-xs btn-primary"
                    href="{{route('users.edit', $user->id)}}">Edit</a>
                @endcan
                @can('delete', $user)
                <form action="{{route('users.destroy', $user->id)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>
                @endcan --}}
            </td>
        </tr>
        @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif
@endsection
