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
      <li> Checkout </li>
    </ol>
    <h2>Checkout</h2>

  </div>
</section><!-- End Breadcrumbs -->

{{-- Shopping Cart --}}
<section id="checkout" class="checkout">
    <div class="container" data-aos="fade-up">
      <!-- Feature Tabs -->
      <form action="{{ route('checkout.store') }}" method="post">
          @csrf
      <div class="row" data-aos="fade-up">
        <div class="col-lg-8">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0 font-lg text-center">Billing Address</h4>
                </div>
                <div class="card-body">
                    <div class="mb-0 mb-md-4">
                      <div class="row font-sm">
                          <div class="col-md-12 form-group">
                              <label>Full Name</label>
                              <input class="form-control form-control-sm" name="name" type="text" placeholder="You Name" value="{{ old('name') }}">
                              @error('name') <span style="color: red"><small>{{$message}}</small></span> @enderror
                          </div>
                          {{-- <div class="col-md-6 form-group"></div> --}}
                          <div class="col-md-6 form-group">
                              <label>E-mail</label>
                              <input class="form-control form-control-sm" name="email" type="email" placeholder="example@email.com" value="{{ old('email') }}">
                              @error('email') <span style="color: red"><small>{{$message}}</small></span> @enderror
                          </div>
                          <div class="col-md-6 form-group">
                              <label>Mobile No</label>
                              <input class="form-control form-control-sm" name="phone" type="text" placeholder="+880171 456 7891" value="{{ old('phone') }}">
                              @error('phone') <span style="color: red"><small>{{$message}}</small></span> @enderror
                          </div>
                          <div class="col-md-6 form-group">
                              <label>Address</label>
                              <textarea class="form-control form-control-sm" name="address" type="text" placeholder="123 Street" rows="3" cols="3">{{ old('address') }}</textarea>
                              @error('address') <span style="color: red"><small>{{$message}}</small></span> @enderror
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Note</label>
                            <textarea class="form-control form-control-sm" name="note" type="text" placeholder="write short notes" rows="3" cols="3">{{ old('note') }}</textarea>
                            @error('note') <span style="color: red"><small>{{$message}}</small></span> @enderror
                          </div>                 
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0 font-lg text-center">Order Total</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless text-center mb-0">
                            <thead class="font-md text-dark">
                                <tr>
                                    <th class="text-start">Products</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle font-sm">
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="align-middle text-start">{{ $item->name }}</td>
                                    <td class="align-middle">{{ number_format($item->price, 2) }}</td>
                                    <td class="align-middle">{{ $item->quantity }}</td>
                                    <td class="align-middle">{{ $item->price * $item->quantity }}/-</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold font-md">Total</h5>
                        <h5 class="font-weight-bold font-md">TK {{ \Cart::getTotal(); }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex justify-content-center mt-2">
            <div class="d-inline-block gap-2">
                <button type="submit" class="btn btn-mod-primary btn-sm my-1 py-2 px-5">Place An Order</button>
            </div>
        </div>
    </div>
    </form>
    </div>
  </section>
@endsection

@push('web-js')
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
