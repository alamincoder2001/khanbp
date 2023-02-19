@extends('layouts.admin-master', ['pageName'=> 'pending', 'title' => 'Invoice'])
{{-- @section('title', 'Our Partner') --}}
@push('admin-css')
@endpush    
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        Order Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Customer Information</h6>
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                          <th scope="row">Name</th>
                                          <td>{{ $orderCustomer->customer->name }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Phone</th>
                                          <td>{{ $orderCustomer->customer->phone }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Email</th>
                                          <td>{{ $orderCustomer->customer->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{ $orderCustomer->customer->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Order Information</h6>
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                          <th scope="row">Invoice No</th>
                                          <td>{{ $orders->invoice_number }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Total Amount</th>
                                          <td>{{ $orders->total_taka }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Order Date</th>
                                            <td>{{ date('F j, Y', strtotime($orders->created_at)) }}</td>
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
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-header">
                <i class="fas fa-list"></i>
                Products
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php
                                dd($orders)
                            @endphp --}}
                            @forelse ($orders->orderDetail as $item)
                                <tr>
                                    <td>{{ $loop->index+1; }}</td>
                                    <td>
                                        @php 
                                            $product = \App\Models\Product::where('id', $item->product_id)->first();
                                            if(isset($product))
                                            {
                                                $lastName = $product->name;
                                            }
                                            else {
                                                $lastName = 'Product Deleted';
                                            }
                                        @endphp
                                        {{ $lastName }}
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->total_taka }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Data Not Found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('admin-js')

@endpush