@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'furniture'
])

@section('content')

<div class="content">
    
<div class="container">
    <h1>Edit Furniture</h1>
    <form action="{{ route('furniture.update', $furniture->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $furniture->name }}">
        </div>
        @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" rows="5" cols="20" name="description">{{ $furniture->description }}</textarea>
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-input" value="{{ $furniture->price }}">
                @error('price')
                    <div class="text-danger">{{$message}}</div>
                @enderror
        </div>
        <div class="form-group">
            <label for="featured" class="form-label">Featured</label>
            <select name="featured" class="form-select">
                <option value="0" {{ $furniture->featured == 0 ? 'selected' : '' }}>Not Checked</option>
                <option value="1" {{ $furniture->featured == 1 ? 'selected' : '' }}>Checked</option>
            </select>
            @error('featured')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id"  class="form-select">
                @foreach($cat as $c)
                    <option value="{{$c->id}}" {{ $c->id == $savedcategory_id ? 'selected' : '' }}>{{$c->name}}</option>
                @endforeach
            </select>
                @error('category_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
        </div>
        <div class="form-group">
            <label for="subcategory_id" class="form-label">Sub-Category</label>
            <select id="subcategory_id" name="subcategory_id" class="form-select">
                @foreach($subcat as $s)
                <option value="{{$s->id}}" {{ $s->id == $savedsubcat_id ? 'selected' : ''}}>{{$s->name}}</option>
                @endforeach
            </select>
            @error('subcategory_id')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Change Image</label>
            <input type="file" class="form-control" name="image">
            @if($furniture->image)
                <img src="{{ asset('storage/' . $furniture->image) }}" alt="Category Image" style="width: 100px;">
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
<script>
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var categoryId = $(this).val();
            var subcategorySelect = $('#subcategory_id');

            // Clear the current options in subcategory dropdown
            subcategorySelect.empty().append('<option>Loading...</option>');

            $.ajax({
                url: '/get-subcategories/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Remove loading option
                    subcategorySelect.empty();

                    // Add new options
                    $.each(data.subcategories, function(index, subcategory) {
                        subcategorySelect.append($('<option>', {
                            value: subcategory.id,
                            text: subcategory.name
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching subcategories:', error);
                    subcategorySelect.empty().append('<option>Error loading subcategories</option>');
                }
            });
        });
    });
</script>
@endsection