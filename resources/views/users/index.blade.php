@extends('layouts.app')
@section('content')
    <h3 class="text-center text-info" >All Users</h3>
    <a href="{{ route('users.create') }}" class="btn btn-dark mb-2">Add user</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Si.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{$role->name}}{{!$loop->last ? ',' : ' '}}
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('users.show',$user->id)}}" class="btn btn-sm btn-dark ms-3">View</a>
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-dark ms-3">Edit</a>
                        <form action="{{route('users.destroy',$user->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ms-3">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
