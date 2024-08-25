@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'checkout',
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
                                    <h3 class="mb-0">Checkout Table</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Buyer Name</th>
                                        <th scope="col">Bought Items</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Date of Purchase</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($checkout as $c)
                                    <tr>
                                        <td>{{$c->webuser->name}}</td>
                                        <td>
                                            @foreach($c->items as $item)
                                                <p>Item Name: {{ $item['name'] }}, Quantity: {{ $item['quantity'] }}, Price: ₹ {{ $item['price'] }}</p>
                                            @endforeach
                                        </td>
                                        <td>₹ {{$c->total}}</td>
                                        <td>{{$c->created_at->format('d-m-Y')}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('checkout.delete', $c->id) }}">Delete</a>
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