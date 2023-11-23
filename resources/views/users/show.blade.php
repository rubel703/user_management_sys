@extends('layouts.app')
@section('content')
    <h3 class="mt-5 text-center text-warning">Show Users</h3>
    <hr class="col-12">
    <div class="row">
        <div class="col-sm-4">
            <label for="" class="text-info fw-bold">Name:</label> <hr class="col-4">
            <p>{{ $users->name }}</p>
        </div>
        <div class="col-sm-4">
            <label for="" class="text-info fw-bold">Email:</label> <hr class="col-4">
            <p>{{ $users->email }}</p>
        </div>
        <div class="col-sm-4">
            <label for="" class="text-info fw-bold">Role:</label> <hr class="col-4">
            <p>
                @foreach ($users->roles as $role)
                    {{ $role->name }}{{ !$loop->last ? ',' : ' ' }}
                @endforeach
            </p>
        </div>
    </div>
@endsection
