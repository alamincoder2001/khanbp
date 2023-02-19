@extends('layouts.website', ['pageName' => 'News'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> News </li>
    </ol>
    <h2>Our News</h2>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Recent Blog Posts Section ======= -->
<section id="recent-blog-posts" class="recent-blog-posts">
    <div class="container" data-aos="fade-up">
      <div class="row gy-2 gy-md-4">

        @foreach($news as $item)
          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="{{ asset($item->image) }}" class="img-fluid" alt=""></div>
              <span class="post-date">{{ date('F j, Y', strtotime($item->created_at)) }}</span>
              <h3 class="post-title">{{ $item->title }}</h3>
              <a href="{{ route('webnews-detail', $item->id) }}" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          @endforeach

      </div>

    </div>

  </section><!-- End Recent Blog Posts Section -->

@endsection