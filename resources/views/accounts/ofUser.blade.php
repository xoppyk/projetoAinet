@extends('layouts.master')

@section('title', 'List Of Accounts')
@section('content')
    @if(count($accounts))
        <a href="{{route('accounts.ofUser', $user)}}" class="btn btn-primary">All Accounts</a>
        <a href="{{route('accounts.ofUserOpened', $user)}}" class="btn btn-success">Opened Accounts</a>
        <a href="{{route('accounts.ofUserClosed', $user)}}" class="btn btn-warning">Closed Accounts</a>
        <hr>
        <table class="table table-bordered table-hover table-responsive-md">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">Code</th>
                <th scope="col">Type</th>
                <th scope="col">Current Balance</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($accounts as $account)
            <tr class="text-center">
                <td>{{$account->code}}</td>
                <td> {{$account->accountType->name}} </td>
                <td> {{$account->current_balance}} </td>
            </tr>
        @endforeach
            </tbody>
        </table>

        <tfoot>
            <nav aria-label="Page of Users">
                <ul class="pagination justify-content-center">
                    {{$accounts->links()}}
                </ul>
            </nav>
        </tfoot>
    @else
        <h2>No accounts found</h2>
    @endif
@endsection
