@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'subcategory'
])

@section('content')
<div class="content">
    
<div class="container">
    <h1>Edit Sub-Category</h1>

    <form action="{{ route('subcategory.update', $subcat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $subcat->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="category_id">Categoory</label>
            <select name="category_id" class="form-control">
                @foreach($cat as $c)
                <option value="{{ $c->id }}" {{ $c->id == $savedcategory_id ? 'selected' : '' }}>
                    {{$c->name}}
                </option>
                @endforeach
            </select>
        </div>
        @error('category_id')
            <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="form-group">
            <label for="image">Change Image</label>
            <input type="file" class="form-control" name="image">
            @if($subcat->image)
                <img src="{{ asset('storage/' . $subcat->image) }}" alt="subcategory Image" style="width: 100px;">
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