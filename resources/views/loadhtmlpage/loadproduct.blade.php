<div class="row">
    <div class="col-lg-12">
        <div class="product-header mb-1 clearfix" style="border-bottom: 1px solid #c5c5c5;">
            {{-- <span class="fw-bold text-uppercase">{{ $products[0]->category->name }}</span> --}}
            <span class="fw-bold text-uppercase">{{ $id[0] == '0' ? 'All Product' : $products[0]->category->name}}</span>
            <a href="{{ route('cat-product', $products[0]->category_id) }}"
                class="float-end btn btn-see-more btn-danger">See More</span></a>
        </div>
    </div>
</div>
    {{-- <div class="owl-carousel owl-theme"> --}}
        <div class="row row-cols-lg-5 gy-lg-2">
            @foreach ($products as $item)
                <div class="col" data-aos="fade-up" data-aos-delay="600">
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
                                    <button type="submit" class="btn btn-sm w-100"><i class="bi bi-cart4"></i> Add to
                                        cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- </div> --}}
        </div>