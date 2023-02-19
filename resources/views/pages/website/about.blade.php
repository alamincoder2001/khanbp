@extends('layouts.website', ['pageName' => 'about'])

@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="{{route('home')}}">Home</a></li>
        <li> About </li>
      </ol>
      <h2>About Us</h2>

    </div>
  </section><!-- End Breadcrumbs -->

  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row gx-0">

        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
          <div class="content ">
            <h3>Who We Are</h3>
            <div class="clearfix">
              <img src="{{ asset($content->about_image) }}" class="img-fluid about-section-img float-md-end ps-md-3 pt-md-2" alt=""> 
              <div class="m-0" style="text-align: justify">
                {!! $content->about !!}
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
          <img src="{{ asset('website/assets/img/about.jpg') }}" class="img-fluid" alt="" style="height: 366px;">
        </div> --}}
      </div>
    </div>
</section><!-- End About Section -->

</main><!-- End #main -->

@endsection