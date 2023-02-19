@extends('layouts.website', ['pageName' => 'cart'])
@push('web-css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endpush
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Cart </li>
    </ol>
    <h2>Shopping Cart</h2>

  </div>
</section><!-- End Breadcrumbs -->


{{-- Shopping Cart --}}
<section id="cart" class="cart">
    <div class="container" data-aos="fade-up">
      <!-- Feature Tabs -->
      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 mb-1">
            <div class="table-responsive">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-light font-md text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Update</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle font-sm">
                    @foreach ($cartItems->sortBy('id') as $item)
                    <tr>
                        <td class="align-middle d-flex">
                            <img src="{{ asset($item->attributes['image']) }}" alt="" style="width: 50px; height: 50px; border-radius: 2px">
                           <span style="align-self: center;padding-left: 10px;font-weight: 600;"> {{ $item->name }}</span>
                        </td>
                        <td class="align-middle">{{ number_format($item->price, 2) }}/-</td>
                        <form action="{{ route('cart.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 116px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-mod-primary btn-minus" >
                                        <i class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                                <input name="quantity" type="text" class="form-control form-control-sm bg-mod-secondary text-center" value="{{ $item->quantity }}">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-mod-primary btn-plus">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">Tk {{ $item->price * $item->quantity }}</td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-sm btn-mod-primary">Update</button>
                        </td>
                        </form>
                        <td class="align-middle"><a href="{{ route('cart.remove', $item->id) }}" class="btn btn-sm btn-mod-primary"><i class="bi bi-x-lg"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-0 pt-0">
                        <h6 class="font-weight-medium font-sm mb-0">Subtotal</h6>
                        <h6 class="font-weight-medium font-sm mb-0">TK. {{ \Cart::getTotal()}}</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-grid gap-2">
                        {{-- @if(\Cart::getTotal() == 0) 
                        <a href="{{ route('product') }}" class="btn btn-primary btn-sm my-1">Proceed To Checkout</a>
                        @else --}}
                        <a href="{{ route('checkout') }}" class="btn btn-success my-1 py-2">Proceed To Checkout</a>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('web-js')
  <script src="{{ asset('website/assets/vendor/jquery-3.6.0.min.js') }}"></script>
  <script>
      // Product Quantity
      $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
  </script>
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
  