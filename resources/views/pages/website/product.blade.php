@extends('layouts.website', ['pageName' => 'Product'])
@section('web-content')
    @push('web-css')
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('website/assets/vendor/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('website/assets/vendor/owl-carousel/owl.theme.default.min.css') }}">
    @endpush

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li> Product </li>
            </ol>
            <h2>Our Products</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    {{-- Search Section --}}
    <section class="search" style="padding-bottom: 0px; padding-top: 22px;">
        <div class="container">
            <form action="{{ route('search') }}" method="get">
                <div class="row">
                    {{-- <div class="col-lg-3">
                        <input type="search" name="q"
                            class="form-control form-control-sm serach-control search-box keyword" id="keyword"
                            autocomplete="off" placeholder="search...">
                    </div> --}}
                    <div class="col-lg-2 px-lg-0">
                        <div class="input-group">
                            <label for="" class="search-lebel">Search By:</label>
                            <select class="form-select form-select-sm" id="search_by" onchange="SearchBy(this.value)">
                                <option value="" selected>Select---</option>
                                <option value="category">Category</option>
                                <option value="model">Model</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 px-lg-0" id="category_column" style="display: none">
                        <div class="input-group">
                            <label for="" class="search-lebel">Category: </label>
                            <select class="form-select form-select-sm" id="category" onchange="SearchProduct(this.value)">
                                <option value="0">All</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 px-lg-0" id="model_column" style="display: none">
                        <div class="input-group">
                            <label for="" class="search-lebel">Model: </label>
                            <select class="form-select form-select-sm" id="model" onchange="SearchProductModel(this.value)">
                                <option value="0">All</option>
                                @foreach ($model as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 ms-auto">
                        <input type="search" name="q"
                            class="form-control form-control-sm serach-control search-box keyword" id="keyword"
                            autocomplete="off" placeholder="search products...">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- ======= Product Section ======= -->
    <section id="products" class="products" style="padding-top: 30px">
        <div class="container" data-aos="fade-up" >
          <div id="replaceProduct">
            @foreach ($category as $item1)
                @if ($item1->product && count($item1->product) > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-header mb-1 clearfix" style="border-bottom: 1px solid #c5c5c5;">
                                <span class="fw-bold text-uppercase">{{ $item1->name }}</span>
                                <a href="{{ route('cat-product', $item1->id) }}"
                                    class="float-end btn btn-see-more btn-danger">See More</span></a>
                            </div>
                        </div>
                        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="600">
                            <div class="owl-carousel owl-theme">
                                @foreach ($item1->product->take(10) as $item)
                                    <div class="item">
                                        <div class="card p-2 p-lg-3" style="position: relative">
                                            <a href="{{ route('product-detail', $item->id) }}"
                                                style="position: absolute; top:0; bottom:0; left:0; right:0; z-index: 1"></a>
                                            <div class="img-box">
                                                <img width="100%" src="{{ asset($item->image) }}" class="card-img-top"
                                                    alt="Avenue Montaigne">
                                            </div>
                                            <div class="card-body p_card text-start">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                                <p style="font-size: 13px; margin-top: 4px; margin-bottom: 2px;"><span
                                                        style="color: #333; font-weight: 700;">Model &nbsp;</span><span
                                                        class="text-danger">{{ @$item->model->name? $item->model->name : 'Unknown' }}</span></p>
                                                <p class="mb-0" style="color: #333; font-weight: 700; font-size: 14px;">TK
                                                    {{ $item->rate }}</p>
                                            </div>
                                            <div class="product-cart">
                                                <form action="{{ route('cart.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-sm w-100"><i
                                                            class="bi bi-cart4"></i> Add to cart</button>
                                                </form>
                                                {{-- <a href="{{ route('cart.store', $item->id) }}" class="btn btn-sm w-100"><i
                                                    class="bi bi-cart4"></i> Add to cart</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
          </div>
        </div>
    </section><!-- End Product Section -->
@endsection

@push('web-js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/bootstrap3-typeahead.min.js') }}"></script>
    <script type="text/javascript">
        var baseUri = "{{ url('/') }}";
        var catId = 0;

        function SearchBy(value) {
            // console.log(value);
            if(value == 'category') {
                $('#category_column').show();
                $('#model_column').hide();
            } else if(value == 'model') {
                $('#model_column').show();
                $('#category_column').hide();
            } else {
                $('#model_column').hide();
                $('#category_column').hide();
            }
        }

        function SearchProduct(id) {
            catId = id;
            $('#keyword').val('');
            console.log(catId)

            $.ajax({
                type: "GET",
                url: "/get-product/"+catId,
                data: '',
                success: function(res) {
                    // console.log(res);
                    $('#replaceProduct').html(res);
                    // $('#replaceProduct').replaceWith( res ) 
                }
            });
        }
        function SearchProductModel(id) {
            modelId = id;
            // console.log(modelId);

            $.ajax({
                type: "GET",
                url: "/get-model/"+modelId,
                data: '',
                success: function(res) {
                    // console.log(res);
                    $('#replaceProduct').html(res);
                    // $('#replaceProduct').replaceWith( res ) 
                }
            });
        }

        $('#keyword').typeahead({
            minLength: 1,
            source: function(keyword, process) {
                return $.get(`${baseUri}/get_suggestions/${keyword}/${catId}`, function(data) {
                    return process(data);
                });
            },
            updater: function(item) {
                $(location).attr('href', `/search?q=${item}&category=${catId}`);
                return item;
            }
        });
    </script>
    <script src="{{ asset('website/assets/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            // autoplay:true,
            // autoplayTimeout:1000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endpush
