@extends('layouts.app')

@section('content')
    <h1>Roles</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create Role</a>

   <ul>
    @foreach ($role->users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>

@endsection
