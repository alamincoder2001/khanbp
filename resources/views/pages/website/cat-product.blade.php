@extends('layouts.website', ['pageName' => 'Products with category'])
@section('web-content')
@push('web-css')
@endpush

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> product  </li>
      <li> {{ $category->name }} </li>
    </ol>
    <h2>All Product of {{ $category->name }}</h2>

  </div>
</section><!-- End Breadcrumbs -->
<!-- ======= Category with Product Section ======= -->
 
<section id="products" class="products">
    <div class="container" data-aos="fade-up">
      <div class="row row-cols-1 row-cols-lg-5 gy-3">
        <div class="col-lg-12">
          <div class="product-header mb-1 clearfix" style="border-bottom: 1px solid #c5c5c5;">
            <span class="fw-bold text-uppercase">{{ $category->name }}</span>
          </div>
        </div>
        @foreach($product as $item)
        <div class="col" data-aos="fade-up" data-aos-delay="600">
          <div class="card p-2 p-lg-3" style="position: relative">
            <a href="{{ route('product-detail', $item->id)}}" style="position: absolute; top:0; bottom:0; left:0; right:0; z-index: 1"></a>
            <div class="img-box">
              <img width="100%" src="{{ asset($item->image) }}" class="card-img-top" alt="Avenue Montaigne">
            </div>
            <div class="card-body p_card text-start">
              <h5 class="card-title">{{ $item->name }}</h5>
              <p style="font-size: 13px; margin-top: 4px; margin-bottom: 2px;"><span style="color: #333; font-weight: 700;">Model &nbsp;</span><span class="text-danger">{{ @$item->model->name? $item->model->name : 'Unknown' }}</span></p>
              <p class="mb-0" style="color: #333; font-weight: 700; font-size: 14px;">TK {{ $item->rate }}</p>
            </div>
            <div class="product-cart">
              <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-sm w-100">Add to cart <i class="bi bi-cart4"></i></button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section><!-- End Product Section -->
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
  