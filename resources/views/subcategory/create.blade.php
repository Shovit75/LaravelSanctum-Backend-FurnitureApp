@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'subcategory'
])

@section('content')
<div class="content">
    <div>
        <h2>Create Sub-Category</h2>
    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <form action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <div class="my-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-input">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            @foreach($cat as $c){
                                <option value="{{$c->id}}" class="form-input">{{$c->name}}</option>
                            }
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-input">
                        @error('image')
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