@extends('layouts.app')

@section('content')
    <h1>Roles</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create Role</a>

    @if ($roles->isEmpty())
        <p>No roles found.</p>
    @else
        <ul>
            @foreach ($roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>
    @endif
@endsection
