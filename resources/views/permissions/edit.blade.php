@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'permissions'
])

@section('content')
<div class="content">
    
<div class="container">
    <h1>Edit Permissions</h1>

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $permission->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror


        <div class="form-group">
            <label for="guard_name">Guard Name</label>
            <input type="text" class="form-control" name="guard_name" value="{{ $permission->guard_name }}">
        </div>
        @error('guard_name')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection

@section('script')
@endsection