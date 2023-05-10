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
                                    data-bs-target="#productModal">Create Order</a>
                            </div>
                            <div class="table">
                                <h5 class="text-left font-weight-bold text-normal opacity-75">List of orders</h5>
                                <table class="table table-bordered table-responsive mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order Number</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>2</td>
                                            <td>20,000</td>
                                            <td><a class="btn btn-outline-primary " href="#">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
