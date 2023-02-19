@extends('layouts.website', ['pageName' => 'Activity'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Activity </li>
    </ol>
    <h2>Our Activity</h2>

  </div>
</section><!-- End Breadcrumbs -->

{{-- Our History --}}
<section id="history" class="history">
    <div class="container" data-aos="fade-up">
      <!-- Feature Tabs -->
      <div class="row history-tabs" data-aos="fade-up">
        <div class="col-lg-12">
          <img src="{{ asset($activity->image) }}" class="img-fluid ms-lg-5 border border-3 custom-border float-end" style="width: 45%" alt="">
          <h3>Activities of Our Company</h3>
          <!-- Tabs -->
          <!-- Tab Content -->
          <div class="tab-content">

            <div class="tab-pane fade show active" id="tab1">
              {!! $activity->description2 !!}
            </div><!-- End Tab 1 Content -->
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
  