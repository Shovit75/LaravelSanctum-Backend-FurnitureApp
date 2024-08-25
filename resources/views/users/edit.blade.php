@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'users'
])

@section('content')
<div class="content">
    
<div class="container">
    <h1>Edit users</h1>
    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $users->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror


        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ $users->email }}">
        </div>
        @error('email')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" placeholder="Enter New Password">
        </div>
        @error('password')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="role">Role</label>
            <select name="roles" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ in_array($role->id, $selectedrole) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('roles')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection

@section('script')
@endsection