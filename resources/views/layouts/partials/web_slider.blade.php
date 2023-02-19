<section id="hero" class="hero slider py-0">
  <div class="swiper mySwiper1" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
    <div class="swiper-wrapper">
      @foreach ($slider as $item)
      <div class="swiper-slide">
        <div class="parallax-bg" style="background-image: url({{ asset($item->image) }});"></div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-12 offset-lg-2">
              <div class="swiper-box">
                <h2 class="title text-center text-white" data-swiper-parallax="-300">{{ $item->slogan }}</h2>
                <h3 class="subtitle text-center text-white" data-swiper-parallax="-200">{{ $item->headerline }}</h3>
                <div class="text" data-swiper-parallax="-100">
                  <p class="text-center text-white">
                    {{ $item->description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>
