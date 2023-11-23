@extends('layouts.app')
@section('content')
    <h3 class="mt-5 text-info ">Edit Users</h3>
    <hr class="col-2">
    <form action="{{ route("users.update",$users->id) }}" method="POST" class="py-2">
        @csrf
        @method('PUT')
        <div class="form-group col-7 mb-2">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$users->name}}" class="form-control"/>
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-7 mb-2">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{$users->email}}" class="form-control"/>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-7 mb-2">
            <label for="password">Password(leave blank to keep current)</label>
            <input type="password" name="password" class="form-control"/>
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-7 mb-2">
            <label for="roles">Roles</label>
            <select class="form-control" multiple name="roles[]" id="">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" 
                        @if(in_array($role->id,$users->roles->pluck('id')->toArray())) 
                        selected 
                        @endif>{{$role->name}}
                    </option>
                @endforeach
            </select>
            @error('roles')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark px-4 mt-2">Update User</button>
    </form>
@endsection
