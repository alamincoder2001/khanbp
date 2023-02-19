@extends('layouts.website', ['pageName' => 'Home'])
@push('web-css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endpush

@section('web-content')
    @include('layouts.partials.web_slider')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Who We Are</h3>
              <div class="about-text">
                {{-- {!! Str::limit($content->about, 600, '...') !!} --}}
                {!! Str::of($content->about)->words(150, '...') !!}
              </div>
              @if(strlen($content->about) > 600)
              <div class="text-center text-lg-start">
                <a href="{{ route('about') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
              @endif
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset($content->about_image) }}" class="img-fluid about-image" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Product Section ======= -->
    <section id="products" class="products">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Products</h2>
          <p><span>Some sample of our products</span></p>
          @if($product->count() > 10)
          <div class="btn-absolute text-center text-lg-start">
            <a href="{{ route('product') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
              <span>See More</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          @endif
        </header>

        <div class="row row-cols-1 row-cols-lg-5 gy-3">
          @foreach($product->take(10) as $item)
          <div class="col" data-aos="fade-up" data-aos-delay="600">
            <div class="card p-2 p-lg-3" style="position: relative">
              <a href="{{ route('product-detail', $item->id)}}" style="position: absolute; top:0; bottom:0; left:0; right:0; z-index: 1"></a>
              <div class="img-box">
                <img width="100%" src="{{ asset($item->image) }}" class="card-img-top" alt="Avenue Montaigne">
              </div>
              <div class="card-body p_card text-start">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p style="font-size: 13px; margin-top: 4px; margin-bottom: 2px;"><span style="color: #333; font-weight: 700;">Model &nbsp;</span><span class="text-danger">{{ @$item->model->name ? $item->model->name : 'Unknown'}}</span></p>
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

    <!-- ======= Speciality Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Speciality</h2>
          <p><span>Our Company's best qualities & specialities</span></p>
        </header>

        <div class="row">
          @foreach($service->take(3) as $item)
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
              <h3>{{ $item->name }}</h3>
              <p style="text-align: justify">{{ $item->s_description }}</p>
            </div>
          </div>
          @endforeach
        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Factory</h2>
          <p><span>Some of our factory information</span></p>
        </header>

        <div class="row">

          <div class="col-lg-8">
            <div class="row align-self-center gy-4">
              <div class="col-lg-6">
                <img src="{{ asset($factory->image1) }}" class="img-fluid border" alt="">
              </div>
              <div class="col-lg-6">
                <img src="{{ asset($factory->image2) }}" class="img-fluid border" alt="">
              </div>
              <div class="col-lg-6">
                <img src="{{ asset($factory->image3) }}" class="img-fluid border" alt="">
              </div>
              <div class="col-lg-6">
                <img src="{{ asset($factory->image4) }}" class="img-fluid border" alt="">
              </div>
            </div>
          </div>

          <div class="col-lg-4 mt-5 mt-lg-0 d-flex">
            <div class="row align-self-center gy-4">

              @foreach ($factorypoint->take(5) as $item)
              <div class="col-md-12" data-aos="zoom-out" data-aos-delay="200">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>{{ $item->title }}</h3>
                </div>
              </div>
              @endforeach
            </div>
          </div>

        </div> <!-- / row -->
      </div>

    </section><!-- End Features Section -->

    <section id="history" class="history">

      <div class="container" data-aos="fade-up">
        <!-- Feature Tabs -->
        <div class="row history-tabs" data-aos="fade-up">
          <div class="col-lg-6">
            <h3>Histories & Activities of Our Company</h3>
  
            <!-- Tabs -->
            <ul class="nav nav-pills mb-3">
              <li>
                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Histories</a>
              </li>
              <li>
                <a class="nav-link" data-bs-toggle="pill" href="#tab2">Activities</a>
              </li>
            </ul><!-- End Tabs -->
  
            <!-- Tab Content -->
            <div class="tab-content">
  
              <div class="tab-pane fade show active" id="tab1">
                <div class="history-box">
                  {!! $history->description1 !!}
                </div>
                <span><a href="{{ route('history') }}">Read More</a></span>
              </div>
              <!-- End Tab 1 Content -->
  
              <div class="tab-pane fade show" id="tab2">
                <div class="history-box">
                  {!! $history->description2 !!}
                </div>
                <span><a href="{{ route('activity') }}">Read More</a></span>
              </div><!-- End Tab 2 Content -->
            </div>
  
          </div>
  
          <div class="col-lg-6">
            <img src="{{ asset($history->image) }}" class="img-fluid ms-lg-5 border border-3 custom-border" alt="">
          </div>
  
        </div><!-- End Feature Tabs -->
      </div>
    </section>


    <!-- ======= Services Section ======= -->
    <section id="services" class="services">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Sister Concern</h2>
          <p><span>Our relations with other companies</span></p>
          @if($sister->count() > 3)
          <div class="btn-absolute text-center text-lg-start">
            <a href="{{ route('sister-concern') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
              <span>See More</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          @endif
        </header>

        <div class="row gy-4">

          @foreach($sister->take(3) as $item)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
              <div class="img-box">
                <img src="{{ asset($item->image) }}" alt="" class="img-fluid rounded">
              </div>
              <h3 class="px-2">{{ $item->name }}</h3>
              <p class="sister-text px-2" style="text-align: justify">{{ Str::limit($item->s_description, 200, '...') }}</p>
            </div>
          </div>
          @endforeach
        </div>

      </div>

    </section><!-- End Services Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p><span>Frequently Asked Questions</span></p>
          @if($faq->count() > 6)
          <div class="btn-absolute text-center text-lg-start">
            <a href="{{ route('faq') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
              <span>See More</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          @endif
        </header>

        <div class="accordion accordion-flush" id="faqlist1">
        <div class="row gy-2">
            @foreach($faq->take(6) as $item)
            <div class="col-lg-6">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $item->id }}">
                    {{ $item->name }}
                  </button>
                </h2>
                <div id="faq-content-{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    {{ $item->details }}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

      </div>

    </section><!-- End F.A.Q Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Gallery</h2>
          <p><span>Check our latest photos</span></p>
          @if($gallery->count() > 12)
          <div class="btn-absolute text-center text-lg-start">
            <a href="{{ route('gallery') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
              <span>See More</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          @endif
        </header>
        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
          @foreach($gallery->take(12) as $item)
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('uploads/gallery/'.$item->image) }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>{{ $item->title }}</h4>
                <div class="portfolio-links">
                  <a href="{{ asset('uploads/gallery/'.$item->image) }}" data-gallery="portfolioGallery{{ $item->event_id }}" class="portfokio-lightbox" title="{{ $item->title }}"><i class="bi bi-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>

    </section><!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Certification</h2>
          <p><span>What they are saying about us</span></p>
        </header>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">
            @foreach($testimonial as $item)
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="{{ asset($item->image) }}" class="testimonial-img" alt="">
                  <h3>{{ $item->name }}</h3>
                  <h4>{{ $item->post }}</h4>
                </div>
                <p>
                  {{ $item->description }}
                </p>
              </div>
            </div><!-- End testimonial item -->
            @endforeach


          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Team</h2>
          <p><span>Our team members</span></p>
          @if($management->count() > 4)
          <div class="btn-absolute text-center text-lg-start">
            <a href="{{ route('team') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
              <span>See More</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          @endif
        </header>

        <div class="row gy-4">
          @foreach($management->take(4) as $item)
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

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Clients</h2>
          <p><span>Some of our clients</span></p>
        </header>
      </div>
      <div class="client-holder">
        <div class="container" data-aos="fade-up">
          <div class="clients-slider swiper">
            <div class="swiper-wrapper align-items-center">
              @foreach ($partner as $item)
              <div class="swiper-slide">
                <img src="{{ asset($item->image) }}" class="img-fluid mb-2" alt="">
                <p class="mb-0">{{ $item->name }}</p>
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>

    </section><!-- End Clients Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>News & Events</h2>
          <p><span>Recent news & events of our company</span></p>
          @if($news->count() > 3)
          <div class="btn-absolute text-center text-lg-start">
            <a href="{{ route('webnews') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
              <span>See More</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          @endif
        </header>

        <div class="row">
          @foreach($news->take(3) as $item)
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

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact</h2>
          <p><span>Contact Us</span></p>
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
            <form action="{{ route('contact.store') }}" method="post" class="php-email-form">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required value="{{ old('name') }}">
                  @error('name') <span style="color: red">{{$message}}</span> @enderror
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required value="{{ old('email') }}">
                  @error('email') <span style="color: red">{{$message}}</span> @enderror
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required value="{{ old('subject') }}">
                  @error('subject') <span style="color: red">{{$message}}</span> @enderror
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required value="{{ old('message') }}"></textarea>
                  @error('message') <span style="color: red">{{$message}}</span> @enderror
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-sm d-inline-block w-100">Send Message</button>
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