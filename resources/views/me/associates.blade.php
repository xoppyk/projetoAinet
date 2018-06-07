@extends('layouts.master')

@section('title', 'List Of Associates')
@section('content')
@if(count($associates))
    <table class="table table-bordered table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($associates as $user)
        <tr class="text-center">
            <td>{{$user->name}}</td>
            <td> {{$user->email}} </td>
            <td>
                <form action="{{route('me.deleteAssociates', $user->id)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>

    <tfoot>
        <nav aria-label="Page of Users">
            <ul class="pagination justify-content-center">
                {{$associates->links()}}
            </ul>
        </nav>
    </tfoot>
@else
    <h2>No associates found</h2>
@endif
@endsection
