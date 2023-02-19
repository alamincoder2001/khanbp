<header id="header" class="header fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between {{ (\Request::route()->getName())=='home'? 'homeClass' : '' }}">

    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
      <img src="{{ asset($content->logo) }}" alt="">
    </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="{{route('home')}}">Home</a></li>
        <li><a class="nav-link scrollto {{(@$pageName=='about')? 'active': ''}}" href="{{ route('about') }}">About</a></li>
        <li><a class="nav-link scrollto" href="{{ route('product') }}">Product</a></li>
        {{-- <li><a class="nav-link scrollto" href="{{ route('cart.index') }}">Cart</a></li> --}}
        <li><a class="nav-link scrollto" href="{{route('home')}}#features">Factory</a></li>
        {{-- <li><a class="nav-link scrollto" href="#history">History</a></li> --}}
        <li><a class="nav-link scrollto" href="{{ route('faq') }}">FAQ</a></li>
        <li class="dropdown gallery"><a href="#"><span>Gallery</span><i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
            <li><a href="{{ route('video') }}">Video Gallery</a></li>
          </ul>
        </li>
        {{-- <li><a class="nav-link scrollto" href="{{ route('gallery') }}">Gallery</a></li> --}}
        <li><a class="nav-link scrollto" href="{{ route('team') }}">Team</a></li>
        <li><a class="nav-link scrollto" href="{{ route('webnews') }}">News</a></li>
        <li><a class="nav-link scrollto" href="{{ route('home') }}#contact">Contact</a></li>
        <li class="nav-link nav-link-last"><a class="nav-link scrollto" href="{{ route('cart.index') }}"><i class="bi bi-cart4">
          <span class="cartItem"> {{ Cart::getTotalQuantity() }}</span>
          </i></a>
        </li>
        {{-- <li class="dropdown">
          <a href="{{ route('cart.index')}}">
            <i class="bi bi-cart4">
              <span class="cartItem"> {{ Cart::getTotalQuantity() }}</span>
            </i>
          </a>
          {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
            <li><a href="{{ route('video') }}">Video Gallery</a></li>
          </ul> 
        </li> --}}
        {{-- <li><a class="nav-link scrollto" href="">
          <i class="bi bi-cart"><span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
          <span class="visually-hidden">New alerts</span></span>
          </i>
          </a>
        </li> --}}
      </ul>
      <a class="nav-link cart-link" href="{{ route('cart.index') }}">
        <i class="bi bi-cart4">
          <span class="cartItem"> {{ Cart::getTotalQuantity() }}</span>
        </i>
      </a>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->