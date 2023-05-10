@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            {{ __('Dashboard') }}
                            <a class="btn btn-outline-warning" href="#" data-bs-toggle="modal" data-bs-target="#productModal">Products</a>
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
                                <a class="btn btn-primary mx-2" href="#" data-bs-toggle="modal" data-bs-target="#productModal">Create Product</a>
                                <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#orderModal">Create Order</a>
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

    {{-- Modals --}}
    
    <div class="modal fade" id="productModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Create new product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-content mt-3">
                    <form action="" method="post">
                        
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Create new product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
