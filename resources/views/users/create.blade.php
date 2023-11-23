@extends('layouts.app')
@section('content')
    <h3 class="mt-5 text-info">Add new Users</h3>
    <hr class="col-2">
    <form action="{{ route("users.store") }}" method="POST" class="py-2">
        @csrf
        <div class="form-group col-7 mb-3">
            <label for="name" class="fw-bold">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Name"/>
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-7 mb-3">
            <label for="email" class="fw-bold">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email"/>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-7 mb-3">
            <label for="password" class="fw-bold">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" />
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-7 mb-2">
            <label for="roles" class="fw-bold">Roles</label>
            <select class="form-control" multiple name="roles[]" id="">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
            @error('roles')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark px-4 mt-2">Create User</button>
    </form>
@endsection
