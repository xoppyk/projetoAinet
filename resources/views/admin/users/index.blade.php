@extends('layouts.master')

@section('title', 'List Of All Users')
@section('content')
    @formFilter(['route' => 'admin.users.index'])
        <div class="d-inline-flex align-items-center p-2">
            @selectFilter([
                'name' => 'type',
                'label' => 'Type:',
                'options' => [
                    ['admin', 'Admin'],
                    ['normal', 'Normal User'],
                ]
            ])
            @endselectFilter
            &nbsp;
            @selectFilter([
                'name' => 'status',
                'label' => 'Status:',
                'options' => [
                    ['block', 'Blocked'],
                    ['unblock', 'Ublocked'],
                ]])
                @endselectFilter
        </div>
        <div class="d-inline-flex ml-auto align-items-center  p-2">
            @nameFilter([
                'name' => 'name',
                'label' => 'Search Name:'
            ])
            @endnameFilter
            @submitButton(['name' => 'Filter']) @endsubmitButton
        </div>
    @endformFilter

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
            <td class="{{userClassAdmin($user)}}">{{ $user->isAdmin }}</td>
            <td class="{{userClassBlocked($user)}}">
                {{ $user->isBlocked }}
            </td>
            <td>
                <div class="d-flex justify-content-around">
                    @if (Auth::user()->can('himself', $user))
                            <form action="{{route('admin.users.toggleState', $user->id)}}" method="POST">
                                @method('patch')
                                @csrf
                                @if ($user->blocked)
                                    <button type="submit" class="btn btn-sm btn-outline-success">Unblock</button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Block</button>
                                @endif
                            </form>
                        &nbsp;
                            <form action="{{route('admin.users.toggleType', $user->id)}}" method="POST">
                                @method('patch')
                                @csrf
                                @if ($user->admin)
                                    <button type="submit" class="btn btn-sm btn-outline-info">Promote</button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-outline-warning">Demote</button>
                                @endif
                            </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <tfoot>
        <nav aria-label="Page of Users">
            <ul class="pagination justify-content-center">
                {{$users->appends(['status' => request('status'), 'type' => request('type'), 'name' => request('name')])->links()}}
            </ul>
        </nav>
    </tfoot>
@else
    <h2>No users found</h2>
@endif
@endsection
