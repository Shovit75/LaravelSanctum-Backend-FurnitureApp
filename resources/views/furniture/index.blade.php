@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'furniture',
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Furnitures Table</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{route('furniture.create')}}" class="btn btn-sm btn-primary">Add Furniture</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Subcategory</th>
                                        <th scope="col">Featured</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($furniture as $f)
                                    <tr>
                                        <td>{{$f->name}}</td>
                                        <td>{{$f->price}}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $f->image) }}" alt="Furniture Image" style="width: 100px;">
                                        </td>
                                        <td>{{$f->category->name}}</td>
                                        <td>{{$f->subcategory->name}}</td>
                                        <td>{{$f->featured}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('furniture.edit', $f->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('furniture.delete', $f->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection