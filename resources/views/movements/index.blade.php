@extends('layouts.master')

@section('title', 'List Of Movements')
@section('content')
    @can('isOwner', $account)
        <a href="{{route('movements.create', $account)}}" class="btn btn-success">Add Movement</a>
        <br>
        <br>
    @endcan
    @if(count($movements))
        <table class="table table-bordered table-hover table-responsive-md">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Value</th>
                <th scope="col">Type</th>
                <th scope="col">End Balance</th>
                <th scope="col">View Document</th>
                @can('isOwner', $account)
                    <th scope="col">Action</th>
                @endcan
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

                @can('isOwner', $account)
                    <td>
                        <a href="{{route('movement.edit', $movement)}}" class="btn btn-primary">Edit</a>
                        @if (isset($movement->document_id))
                            <form action="{{route('document.delete', $movement->document_id)}}" method="POST" role="form" class="inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-xs btn-warning">Delete Document</button>
                            </form>
                        @else
                            <a href="{{route('document.create', $movement->id)}}" class="btn btn-success">Add Document</a>
                        @endif
                        <form action="{{route('movement.destroy', $movement->id)}}" method="POST" role="form" class="inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>
                    </td>
                @endcan
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
