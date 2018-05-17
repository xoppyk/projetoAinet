@extends('layouts.master')

@section('title', 'List Of Profiles')
@section('content')
    {{-- Filter Form --}}
    {{-- <form class="" action="{{route('users.index')}}" method="GET">
        <div class="d-flex justify-content-center">
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
    <br> --}}
    @if(count($users))
    <table class="table table-bordered table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Photo</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Associates</th>
            <th scope="col">Associates Of</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr class="text-center">
            <td>Photo</td>
            <td>{{ $user->id}}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $associates->contains($user) ? 'S' : ''}}</td>
            <td>{{ $associatesOf->contains($user) ? 'S' : ''}}</td>
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
