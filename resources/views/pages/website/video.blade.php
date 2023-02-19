@extends('layouts.website', ['pageName' => 'Video'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Video </li>
    </ol>
    <h2>All Videos</h2>

  </div>
</section><!-- End Breadcrumbs -->

   <!-- ======= Video Section ======= -->
   <section id="video" class="video">

    <div class="container" data-aos="fade-up">
      <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

        @foreach($video as $item)
        <div class="col-lg-3 col-md-6 portfolio-item filter-app">
          <h6 class="fw-bold text-center">{{ $item->name }}</h6>        
            <div class="">
              <iframe width="100%" height="150" src="{{ $item->link }}" title="YouTube video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div>
        </div>
        @endforeach  
      </div>
    </div>
  </section>

@endsection
  