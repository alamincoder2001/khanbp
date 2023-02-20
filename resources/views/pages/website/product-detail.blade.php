@extends('layouts.website', ['pageName' => 'Product'])
@section('web-content')
@push('web-css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endpush
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Product Details </li>
    </ol>
    <h2>{{ $product->name }}</h2>

  </div>
</section><!-- End Breadcrumbs -->

 <!-- ======= Portfolio Details Section ======= -->
 <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-6">
          <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">

              <div class="swiper-slide">
                <img src="{{ asset($product->image_thumb) }}" alt="">
              </div>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="portfolio-description">
            <h2>Product Information</h2>
            <p><strong>Product Name: </strong>{{ $product->name }}</p>
            <h6><strong>Model: </strong> {{ @$product->model->name? $product->model->name : 'Unknown' }}</h6>
            <div>
            <div>
              <strong>Description: </strong>
              {!! $product->description !!}
            </div>
            <form action="{{ route('cart.store') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="quantity">

              <div class="mb-2"><strong>Quantity:</strong> </div>
              <div class="input-group quantity me-auto" style="width: 100px;">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-mod-primary btn-minus" >
                        <i class="bi bi-dash-lg"></i>
                    </button>
                </div>
                <input type="text" name="quantity" class="form-control form-control-sm bg-mod-secondary text-center" value="1">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-mod-primary btn-plus">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
              </div>
            </div>
            <div class="pt-3 pt-md-4">
                <button type="submit" class="btn button-2 btn-card">Add To Cart</button>
            </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

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
@endpush