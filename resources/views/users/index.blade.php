@extends('layouts.master')

@section('title', 'List Of All Users')
@section('content')
    {{-- Filter Form --}}
    <form class="" action="{{route('users.index')}}" method="GET">
        {{-- <div class="d-flex justify-content-center"> --}}
        <div class="d-flex">
            <div class="d-inline-flex align-items-center p-2 ">
                <label class="mr-sm-2 mb-0">Type: </label>
                <select name="type" class="form-control">
                    <option selected> All </option>
                    <option value="normal">Normal User</option>
                    <option value="admin">Admin</option>
                </select>
                &nbsp;
                <label class="mr-sm-2 mb-0">Status: </label>
                <select name="status" class="form-control">
                    <option selected> All </option>
                    <option value="blocked" {{request('status') == 'blocked' ? 'selected' : ''}}>Blocked</option>
                    <option value="unblocked" {{request('status') == 'unblocked' ? 'selected' : ''}}>Unblocked</option>
                </select>
            </div>
            <div class="d-inline-flex ml-auto align-items-center  p-2">
                <label class="text-nowrap mr-sm-2 mb-0">Search Name:</label>
                <input type="text" name="name" value="{{request('name') ?? ''}}" class="form-control mr-sm-2 mb-2 mb-sm-0">
                <input type="submit" class="btn btn-primary mr-sm-2 mb-0" value="Filter"></input>
            </div>
            </div>
    </form>
    <br>
    @if(count($users))
    <table class="table table-bordered table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr class="text-center">
            <td>{{ $user->email}}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $user->isAdmin }}</td>
            <td>{{ $user->isBlocked }}</td>
            <td>
                <div class="d-flex justify-content-around">
                @if (Auth::user()->can('himself', $user))
                    @if ($user->blocked)
                        <form action="{{route('users.unblock', $user->id)}}" method="POST">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">Unblock</button>
                        </form>
                    @else
                        <form action="{{route('users.block', $user->id)}}" method="POST">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Block</button>
                        </form>
                    @endif
                    &nbsp;
                    @if ($user->admin)
                        <form action="{{route('users.demote', $user->id)}}" method="POST">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-warning">Demote</button>
                        </form>
                    @else
                        <form action="{{route('users.promote', $user->id)}}" method="POST">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-info">Promote</button>
                        </form>
                    @endif
                @endif

            {{-- </div> --}}
            </div>

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
