@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'furniture'
])

@section('content')

<div class="content">
    <div>
        <h2>Create Furniture</h2>
    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <form action="{{route('furniture.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <div class="my-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-input">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea rows="5" cols="20" name="description"></textarea>
                        @error('description')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-input">
                        @error('price')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="featured" class="form-label">Featured</label>
                        <select name="featured" class="form-select">
                            <option>Select One</option>
                            <option value="0">Not Checked</option>
                            <option value="1">Checked</option>
                        </select>
                        @error('featured')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id"  class="form-select">
                            <option>Select Category</option>
                            @foreach($cat as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="subcategory_id" class="form-label">Sub-Category</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-select">
                            <option>Select Category First</option>
                        </select>
                        @error('subcategory_id')
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