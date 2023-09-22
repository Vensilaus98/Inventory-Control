@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            Orders
                            <a class="btn btn-outline-warning" href="{{ route('products.index') }}">Products</a>
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
                        <a href="#" class="btn btn-outline-primary btn-sm addProduct">Add Product</a>
                    </div>
                    <hr />
                    <form class="form mt-3" action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <table class="table table-bordered" id="orderProductsTable">
                                    <thead>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="col-md-12 col-lg-12 mt-1">
                                                    <select class="form-control" name="product_id" id="product_id">
                                                        <option value="">Select product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12 col-lg-12 mt-1">
                                                    <input class="form-control" min="1" type="number"
                                                        name="quantity" id="quantity" placeholder="Enter quantity">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12 col-lg-12 mt-1">
                                                    <input class="form-control" min="1" type="number" name="price"
                                                        id="price" placeholder="Enter price" disabled>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12 col-lg-12 mt-1">
                                                    <input class="form-control" min="1" type="number" name="amount"
                                                        id="amount" placeholder="Enter amount">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-outline-danger btn-sm removeProduct">Remove</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
@section('script')
    <script>
        $(document).ready(function() {

            //check changed product
            $('#product_id').change(function() {

                let product_id = $('#product_id').val();

                var urlB = "{{ route('products.getData', ':id') }}";
                url = urlB.replace(':id', product_id);

                //make ajax request for product details
                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        product_id: product_id
                    },
                    success: function(result) {
                        if (result.status === true) {

                        } else {
                            console.log(result.data);
                        }
                    },
                    error: function(error) {

                    }
                });
            });

            let i = 0;

            //add row buttons
            jQuery('.addProduct').click(function() {
                i--;
                jQuery('#orderProductsTable').append('<tr id="row' + i +
                    '"><td><input type="text" id="bus_class_' + i +
                    '" name="bus_class[]" placeholder="Enter class name" class="form-control"><small class="text-danger" id="error_bus_class' +
                    i + '"></small></td><td><a href="#" id="' + i +
                    '" name="remove" class="action-icon text-danger removeClassRow"> <i class="uil uil-trash"></i> Remove</a></td></tr>'
                );
            });

            //remove row buttons
            jQuery(document).on('click', '.removeProduct', function() {
                let button_id = jQuery(this).attr("id");
                jQuery('#row' + button_id + '').remove();
            });
        });
    </script>
@endsection
