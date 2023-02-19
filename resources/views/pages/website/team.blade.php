@extends('layouts.website', ['pageName' => 'Team'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Team </li>
    </ol>
    <h2>Our Team</h2>

  </div>
</section><!-- End Breadcrumbs -->

   <!-- ======= Team Section ======= -->
   <section id="team" class="team">

    <div class="container" data-aos="fade-up">

      <div class="row gy-4">

        @foreach($management as $item)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-img">
                <img src="{{ asset('uploads/management/'. $item->image) }}" class="img-fluid" alt="">
                <div class="social">
                  <a href="{{ $item->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a>
                  <a href="{{ $item->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="{{ $item->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>{{ $item->name }}</h4>
                <span>{{ $item->designation }}</span>
              </div>
            </div>
          </div>
          @endforeach
      </div>

    </div>

  </section><!-- End Team Section -->

@endsection