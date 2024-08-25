@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'category'
])

@section('content')
<div class="content">
    
<div class="container">
    <h1>Edit Category</h1>

    <form action="{{ route('category.update', $cat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $cat->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="image">Change Image</label>
            <input type="file" class="form-control" name="image">
            @if($cat->image)
                <img src="{{ asset('storage/' . $cat->image) }}" alt="Category Image" style="width: 100px;">
            @endif
        </div>
        @error('image')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection

@section('script')
@endsection