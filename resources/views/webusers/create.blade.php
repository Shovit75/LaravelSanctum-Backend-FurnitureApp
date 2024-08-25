@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'webusers'
])

@section('content')
<div class="content">
    <div>
        <h2>Create webusers</h2>
    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <form action="{{route('webusers.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <div class="my-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-input">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-input">
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-input">
                        @error('password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection