@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            Products
                            <a class="btn btn-outline-warning" href="{{ route('orders.index') }}">Home</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="content mt-3">
                            <h5 class="text-center font-weight-bold text-uppercase">Inventory Control MS</h5>
                            <hr />
                            <div class="d-flex align-items-center justify-content-end pr-4 mt-4">
                                <a class="btn btn-primary mx-2" href="#" data-bs-toggle="modal"
                                    data-bs-target="#productModal">Create Product</a>
                            </div>
                            <div class="table">
                                <h5 class="text-left font-weight-bold text-normal opacity-75">List of products</h5>
                                <table class="table table-bordered table-responsive mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->product_no }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->amount }}</td>
                                                <td>20,000</td>
                                                @if ($product->quantity < 10)
                                                    <td><a class="btn btn-outline-danger" href="#" onclick="restockProduct(<?php echo $product->id?>)">Restock</a></td>
                                                @endif
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
    </div>

    {{-- Modals --}}
    <div class="modal fade" id="productModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form mt-3" action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="modal-header bg-default opacity-50">
                        <h5 class="modal-title" id="productModalLabel">Create new product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="name">Name</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" type="text" name="name" id="name"
                                                    placeholder="Enter name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="product">Quantity</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" min="1" type="number" name="quantity"
                                                    id="quantity" placeholder="Enter quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="price">Price</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" min="1" type="number" name="price"
                                                    id="price" placeholder="Enter price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="amount">Expiry date</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" type="date" name="expiry" id="expiry"
                                                    placeholder="Enter expiry date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Restock modal dialog --}}
    <div class="modal fade" id="restockProductModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="restockProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form mt-3" action="{{ route('products.restock') }}" method="post">
                    @csrf
                    <div class="modal-header bg-default opacity-50">
                        <h5 class="modal-title" id="productModalLabel">Restock product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="product">Quantity</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" min="1" type="number"
                                                    name="quantity" id="quantity" placeholder="Enter quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <label for="amount">Expiry date</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-1">
                                                <input class="form-control" type="date" name="expiry" id="expiry"
                                                    placeholder="Enter expiry date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
