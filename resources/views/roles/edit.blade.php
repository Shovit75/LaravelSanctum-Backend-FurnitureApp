@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'roles'
])

@section('content')
<div class="content">
    
<div class="container">
    <h1>Edit Roles</h1>
    <form action="{{ route('roles.update', $roles->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $roles->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="guard_name">Guard Name</label>
            <input type="text" class="form-control" name="guard_name" value="{{ $roles->guard_name }}">
        </div>
        @error('guard_name')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="permissions" class="form-label">Permissions</label>
            <select name="permissions[]" class="form-select" multiple>
                @foreach($permissions as $p)
                <option value="{{ $p->name }}" {{ in_array($p->id, $selectedpermissions) ? 'selected' : '' }}>
                    {{$p->name}}
                </option>
                @endforeach
            </select>
            @error('permissions')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection

@section('script')
@endsection