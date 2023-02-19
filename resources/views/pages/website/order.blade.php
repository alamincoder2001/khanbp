@extends('layouts.website', ['pageName' => 'Order'])
@push('web-css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endpush
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Order </li>
    </ol>
    <h2>Order Us</h2>

  </div>
</section><!-- End Breadcrumbs -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Order</h2>
        <p>Order Us</p>
      </header>

      <div class="row gy-4">

        <div class="col-lg-6">

          <div class="row gy-4">
            <div class="col-md-6">
              <div class="info-box text-center">
                <i class="bi bi-geo-alt"></i>
                <h3>Address</h3>
                <p>{{ $content->address }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box text-center">
                <i class="bi bi-telephone"></i>
                <h3>Call Us</h3>
                <p>{{ '+88'.$content->phone }}</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="info-box text-center">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>{{ $content->email }}</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="{{ route('store.message') }}" method="post" class="php-email-form">
            @csrf
            <div class="row gy-4">

              
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                @error('name') <span style="color: red">{{$message}}</span> @enderror
              </div>
              
              <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                @error('email') <span style="color: red">{{$message}}</span> @enderror
              </div>

              <div class="col-md-12">
                <input type="text" name="product_id" class="form-control" placeholder="" value="{{ $product->product_id }}" readonly>
                @error('product_id') <span style="color: red">{{$message}}</span> @enderror
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                @error('subject') <span style="color: red">{{$message}}</span> @enderror
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                @error('message') <span style="color: red">{{$message}}</span> @enderror
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm d-inline-block w-100">Order Now</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section><!-- End Contact Section -->

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