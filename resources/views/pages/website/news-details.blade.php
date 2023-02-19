	@extends('layouts.website', ['pageName' => 'news'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
	<div class="container">
  
	  <ol>
		<li><a href="{{route('home')}}">Home</a></li>
		<li> News Title </li>
	  </ol>
	  <h2>{{ $news->title  }}</h2>
  
	</div>
  </section><!-- End Breadcrumbs -->

<section id="news-details" class="news-details section-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12">
				<h2 class="fs-2 fw-bold text-center text-uppercase text-white"><span class="section-border">News & Events</span></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-12">
				<div class="img-box">
					<img src="{{ asset($news->image) }}" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-md-6 col-12">
				<div class="details-box">
					<div class="date float-end" style="text-decoration: underline">{{ date('F j, Y', strtotime($news->created_at)) }}</div>
					<h4>{{ $news->title }}</h4>
					<p style="text-align: justify"><strong>Description: </strong>{{ $news->description }}</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection