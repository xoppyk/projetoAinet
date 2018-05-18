@extends('layouts.master')

@section('title', 'List Of Profiles')
@section('content')
    @formFilter(['route' => 'me.index'])
            @nameFilter([
                'name' => 'name',
                'label' => 'Search Name:'
            ])
            @endselectFilter
            @submitButton(['name' => 'Filter']) @endsubmitButton
    @endformFilter
    <br>
    @if(count($users))
    <table class="table table-bordered table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Associates</th>
            <th scope="col">Associates Of</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr class="text-center">
            <td><img src="{{profile_photo($user)}}" class="img-thumbnail rounded-circle table-image" alt="avatar"></td>
            <td>{{$user->name}}</td>
            <td>
                @if($associates->contains($user))
                    <span>associate</span>
                @endif
            </td>
            <td>
                @if($associatesOf->contains($user))
                    <span>associate-of</span>
                @endif
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>

    <tfoot>
        <nav aria-label="Page of Users">
            <ul class="pagination justify-content-center">
                {{$users->appends(['name' => request('name')])->links()}}
            </ul>
        </nav>
    </tfoot>

@else
    <h2>No users found</h2>
@endif
@endsection
