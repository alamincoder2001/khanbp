@extends('layouts.website', ['pageName' => 'FAQ'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('home')}}">Home</a></li>
      <li> Faq </li>
    </ol>
    <h2>Frequently Asked Questions</h2>

  </div>
</section><!-- End Breadcrumbs -->

 <!-- ======= F.A.Q Section ======= -->
 <section id="faq" class="faq">

    <div class="container" data-aos="fade-up">
      <div class="accordion accordion-flush" id="faqlist1">
        <div class="row gy-2">
            @foreach($faq as $item)
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

    </div>

  </section><!-- End F.A.Q Section -->

@endsection
  