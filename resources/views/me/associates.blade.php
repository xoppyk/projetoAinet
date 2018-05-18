@extends('layouts.master')

@section('title', 'List Of Associates')
@section('content')
    @if(count($associates))
    <table class="table table-bordered table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($associates as $user)
        <tr class="text-center">
            {{-- <td><img src="{{profile_photo(data_get($user,'profile_photo'))}}" class="img-thumbnail rounded-circle table-image" alt="avatar"></td> --}}
            <td>{{data_get($user,'name')}}</td>
            <td> {{data_get($user,'email')}} </td>
            {{-- <td>
                @if($associates->contains($user))
                    <span>associate</span>
                @endif
            </td>
            <td>
                @if($associatesOf->contains($user))
                    <span>associate-of</span>
                @endif
            </td> --}}
        </tr>
    @endforeach
        </tbody>
    </table>

    <tfoot>
        <nav aria-label="Page of Users">
            <ul class="pagination justify-content-center">
                {{-- {{$users->appends(['name' => request('name')])->links()}} --}}
            </ul>
        </nav>
    </tfoot>

@else
    <h2>No associates found</h2>
@endif
@endsection
