@extends('layouts.website', ['pageName' => 'Not Found'])
@section('web-content')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
	<div class="container">
  
	  <ol>
		<li><a href="{{route('home')}}">Home</a></li>
		<li> Not Found </li>
	  </ol>
	  <h2>Not Found</h2>
  
	</div>
  </section><!-- End Breadcrumbs -->

<section id="news-details" class="news-details section-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12">
				<h2 class="fs-2 fw-bold text-center text-uppercase"><span class="section-border">Not Found</span></h2>
			</div>
		</div>
	</div>
</section>

@endsection