@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'webusers',
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
                                    <h3 class="mb-0">Webusers Table</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{route('webusers.create')}}" class="btn btn-sm btn-primary">Add webusers</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Logged In App ( Token )</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($webuser as $u)
                                    <tr>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>
                                        @if($u->tokens->count())
                                            @foreach($u->tokens as $token)
                                                <p>{{ $token->token }}</p>
                                            @endforeach
                                        @else
                                            <p>Not logged in</p>
                                        @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('webusers.edit', $u->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('webusers.delete', $u->id) }}">Delete</a>
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