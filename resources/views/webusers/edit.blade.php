@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'webusers'
])

@section('content')
<div class="content">
    
<div class="container">
    <h1>Edit webusers</h1>
    <form action="{{ route('webusers.update', $webuser->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $webuser->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror


        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ $webuser->email }}">
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

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection

@section('script')
@endsection