@extends('layouts.website', ['pageName' => 'Gallery'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Events </li>
    </ol>
    <h2>Our Events</h2>

  </div>
</section><!-- End Breadcrumbs -->

   <!-- ======= Portfolio Section ======= -->
   {{-- <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      @foreach ($event as $item1)
      @if($item1->gallery && count($item1->gallery) > 0)
      <div class="row gy-4 mb-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-12">
          <div class="product-header mb-3 clearfix" style="border-bottom: 1px solid #c5c5c5;">
            <span class="">{{ $item1->name }}</span>
            <a href="{{ route('event-gallery', $item1->id) }}" class="float-end btn btn-sm btn-primary">See More</span></a>
          </div>
        </div>
        @foreach($item1->gallery->take(8) as $item)
        <div class="col-lg-3 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="{{ asset('uploads/gallery/'.$item->image) }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{ $item->title }}</h4>
              <div class="portfolio-links">
                <a href="{{ asset('uploads/gallery/'.$item->image) }}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="{{ $item->title }}"><i class="bi bi-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
      @endforeach
    </div>
  </section><!-- End Portfolio Section --> --}}

    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4 mb-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
          @foreach ($event as $item)
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <div class="card">
              <img src="{{ asset($item->image) }}" class="card-img-top" alt="">
              <div class="card-body">
                <h5 class="card-title">{{ $item->name }} ({{ $item->gallery->count() }})</h5>
              </div>
              <a class="event-link" href="{{ route('event-gallery', $item->id) }}"></a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection
  