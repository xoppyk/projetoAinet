@extends('layouts.master')

@section('title', 'List Of Associates')
@section('content')
@if(count($associates))
    <table class="table table-bordered table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Name</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($associates as $user)
        <tr class="text-center">
            <td>{{$user->name}}</td>
            <td> {{$user->email}} </td>
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