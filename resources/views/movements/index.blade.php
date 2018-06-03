@extends('layouts.master')

@section('title', 'List Of Movements')
@section('content')
    <a href="{{route('movements.create', $account)}}" class="btn btn-success">Add Movement</a>
    <br>
    <br>
    @if(count($movements))
        <table class="table table-bordered table-hover table-responsive-md">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Value</th>
                <th scope="col">Type</th>
                <th scope="col">End Balance</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($movements as $movement)
            <tr class="text-center">
                <td>{{$movement->movementCategorie->name}}</td>
                <td> {{$movement->date}} </td>
                <td> {{$movement->value}} </td>
                <td> {{$movement->type}} </td>
                <td> {{$movement->end_balance}} </td>
                <td> <a href="#"></a> </td>
            </tr>
        @endforeach
            </tbody>
        </table>

        <tfoot>
            <nav aria-label="Page of Users">
                <ul class="pagination justify-content-center">
                    {{$movements->links()}}
                </ul>
            </nav>
        </tfoot>
    @else
        <h2>No Movements found</h2>
    @endif
@endsection
