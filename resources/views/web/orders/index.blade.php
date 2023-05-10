@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            Orders
                            <a class="btn btn-outline-warning" href="#" data-bs-toggle="modal"
                                data-bs-target="#productModal">Home</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="content mt-3">
                            <h5 class="text-center font-weight-bold text-uppercase">Inventory Control MS</h5>
                            <hr />
                            <div class="d-flex align-items-center justify-content-end pr-4 mt-4">
                                <a class="btn btn-primary mx-2" href="#" data-bs-toggle="modal"
                                    data-bs-target="#orderModal">Create Order</a>
                            </div>
                            <div class="table">
                                <h5 class="text-left font-weight-bold text-normal opacity-75">List of orders</h5>
                                @if (count($orders) <= 0)
                                    <hr />
                                    <div class="card">
                                        <div class="card-body text-center"><small class="text-warning">No order(s)
                                                found</small></div>
                                    </div>
                                @else
                                    <table class="table table-bordered table-responsive mt-4">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Number</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <th scope="row">{{ $order->order_no }}</th>
                                                    <td>{{ $order->amount }}</td>
                                                    <td><a class="btn btn-outline-primary "
                                                            href="{{ route('orders.show', $order->id) }}">View</a></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <div class="modal fade" id="orderModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="orderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-default opacity-50">
                    <h5 class="modal-title" id="orderModalLabel">Create new order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="#" class="btn btn-primary">Add Product</a>
                    </div>
                    <hr/>
                    <form class="form mt-3" action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div x-data="{ show: false }">
                                <a href="#" @click="show = !show">Show</a>
                                <h1 x-show="!show">Hello Alpine.js</h1>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="product">Product</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <select class="form-control" name="product_id" id="product_id">
                                                    <option value="">Select product</option>
                                                    <option value="1">Product 1</option>
                                                    <option value="2">Product 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="product">Quantity</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" min="1" type="number" name="quantity" id="quantity" placeholder="Enter quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="price">Price</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" min="1" type="number" name="price" id="price" placeholder="Enter price" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="amount">Amount</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" min="1" type="number" name="amount" id="amount" placeholder="Enter amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end mt-3">
                                    <a href="#" class="btn btn-danger">Remove Product</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
