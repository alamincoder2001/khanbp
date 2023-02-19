@extends('layouts.website', ['pageName' => 'Order Placed'])
@push('web-css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endpush
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Order Placed </li>
    </ol>
    <div>
        <h2>Order Placed</h2>
    </div>

  </div>
</section><!-- End Breadcrumbs -->


{{-- Shopping Cart --}}
<section id="cart" class="cart">
    <div class="container">
      <!-- Feature Tabs -->
      <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="text-center text-primary p-5">Yea! Your order placed successfully. We will contact with your very soon. Thank you.</h4>
                    <h5>Order Summery:</h5>
                    <table class="table table-bordered">
                        <thead>
                            <th>sl</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Total Taka</th>
                        </thead>
                        @php $qty = 0; @endphp
                        <tbody>
                            @foreach ($details[0]->orderDetail as $key=> $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->product_id }}</td>
                                    <td>
                                        @php
                                           $image = App\Models\Product::find($item->product_id)->image 
                                        @endphp
                                        <img src="{{ asset($image) }}" alt="" width="36px" height="30px">
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                </tr>  
                                @php $qty += $item->quantity; @endphp                              
                            @endforeach
                            <tr>
                                <th colspan="3">Total</th>
                                <td>{{ $qty }}</td>
                                <td>{{ $details[0]->total_taka}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-success" href="{{ route('home') }}">Back to Home</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('web-js')
  <script src="{{ asset('website/assets/vendor/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

  <script src="{{ asset('js/toastr.min.js') }}"></script>
  <script>
      @if(Session::has('success'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
      toastr.success("{{ session('success') }}");
      @endif
  
      @if(Session::has('error'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.error("{{ session('error') }}");
      @endif
  </script>
@endpush
  