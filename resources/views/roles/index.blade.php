@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'roles',
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
                                    <h3 class="mb-0">Roles Table</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{route('roles.create')}}" class="btn btn-sm btn-primary">Add Roles</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Guard</th>
                                        <th scope="col">Permissions</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $r)
                                    <tr>
                                        <td>{{$r->name}}</td>
                                        <td>{{$r->guard_name}}</td>
                                        <td>
                                            @foreach($r->permissions as $p)
                                                {{$p->name}}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('roles.edit', $r->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('roles.delete', $r->id) }}">Delete</a>
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