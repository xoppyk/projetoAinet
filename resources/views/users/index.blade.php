@extends('layouts.master')

@section('title', 'List Of All Users')
@section('content')
    {{-- Filter Form --}}
    <form class="form-inline d-flex justify-content-center" action="{{route('users.index')}}" method="GET">
        {{-- <div class="d-flex justify-content-center"> --}}

            <label class="mr-sm-2 mb-0">Type: </label>
            <select name="type" class="form-control mr-sm-2 mb-2 mb-sm-0">
                <option selected> All </option>
                <option value="normal">Normal User</option>
                <option value="admin">Admin</option>
            </select>

            <label class="mr-sm-2 mb-0">Status: </label>
            <select name="status" class="form-control mr-sm-2 mb-2 mb-sm-0">
                <option selected> All </option>
                <option value="blocked" {{request('status') == 'blocked' ? 'selected' : ''}}>Blocked</option>
                <option value="unblocked" {{request('status') == 'unblocked' ? 'selected' : ''}}>Unblocked</option>
            </select>

                {{-- <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="type" {{request('admin') ? 'checked' : ''}} value="admin"> Admin &nbsp;
                </label> --}}
            {{-- <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="status" {{request('status') == 'blocked' ? 'checked' : ''}} value="blocked"> Blocked
            </label> --}}
            <label class="mr-sm-2 mb-0">Search Name:</label>
            <input type="text" name="name" value="{{request('name') ?? ''}}" class="form-control mr-sm-2 mb-2 mb-sm-0">
            <input type="submit" class="btn btn-primary mt-2 mt-sm-0" value="Filter"></input>
        {{-- </div> --}}
    </form>
    <br>
    @if(count($users))
    <table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Email</th>
            <th>Name</th>
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
        </tbody>
    </table>
    <tfoot>
        <nav aria-label="Page of Users">
            <ul class="pagination justify-content-center">
                {{$users->links()}}
            </ul>
        </nav>
    </tfoot>

@else
    <h2>No users found</h2>
@endif
@endsection
