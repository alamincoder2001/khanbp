@extends('layouts.website', ['pageName' => 'Sister-Concern'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Sister Concern </li>
    </ol>
    <h2>Sister Concerns</h2>

  </div>
</section><!-- End Breadcrumbs -->


    <!-- ======= Sister Concern Section ======= -->
    <section id="services" class="services">

        <div class="container" data-aos="fade-up">  
          <div class="row gy-4">

            @foreach($sister as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="service-box blue">
                <div class="img-box p-lg-5 pt-lg-0">
                  <img src="{{ asset($item->image) }}" alt="" class="img-fluid rounded">
                </div>
                <h3>{{ $item->name }}</h3>
                <p>{{ $item->s_description }}</p>
              </div>
            </div>
            @endforeach
          </div>
  
        </div>
  
      </section><!-- End Sister Concern Section -->

@endsection
  