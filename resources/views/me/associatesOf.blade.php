@extends('layouts.master')

@section('title', 'List Of Associates')
@section('content')
    @if(count($associatesOf))
        <table class="table table-bordered table-hover table-responsive-md">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($associatesOf as $associateUser)
                <tr class="text-center">
                    <td>{{$associateUser->name}}</td>
                    <td> {{$associateUser->email}} </td>
                    <td> <a href="{{route('accounts.ofUser', $associateUser)}}" class="btn btn-primary">Accounts</a> </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <tfoot>
        <nav aria-label="Page of Users">
            <ul class="pagination justify-content-center">
                {{$associatesOf->links()}}
            </ul>
        </nav>
    </tfoot>

@else
    <h2>No associatesOf found</h2>
@endif
@endsection
