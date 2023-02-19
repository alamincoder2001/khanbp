<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ ($pageName == 'content' || $pageName == 'slide' || $pageName == 'speciality'|| $pageName == 'factory' || $pageName == 'sister' || $pageName == 'news' || $pageName == 'faq' || $pageName == 'testimonial' || $pageName == 'management' || $pageName == 'video' || $pageName == 'event' || $pageName == 'gallery' || $pageName == 'category' || $pageName == 'product' || $pageName == 'model' || $pageName == 'unit' || $pageName == 'partner' || $pageName == 'whatcontent' || $pageName ==  'map' ? 'active' : 'collapsed') }}" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Web Content
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'content' || $pageName == 'slider' || $pageName == 'speciality'|| $pageName == 'factory'|| $pageName == 'sister' || $pageName == 'news' || $pageName == 'faq' || $pageName == 'testimonial' || $pageName == 'management' || $pageName == 'video' || $pageName == 'event' || $pageName == 'gallery' || $pageName == 'category' || $pageName == 'product' || $pageName == 'model' || $pageName == 'unit' || $pageName == 'partner' || $pageName == 'whatcontent' || $pageName ==  'map' ? 'show' : '') }}" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('company.edit') }}">Company Content</a>
                        <a class="nav-link" href="{{ route('slider.index') }}">Slider</a>
                        <!-- <a class="nav-link" href="{{ route('whatwe.edit') }}">About Us</a> -->
                        <!-- <a class="nav-link" href="{{ route('backimage.edit') }}">Background Image</a> -->
                        <!-- <a class="nav-link" href="{{ route('service') }}">Service</a> -->
                        <!-- <a class="nav-link" href="{{ route('admin.subcategories') }}">Subcategory</a> -->
                        <a class="nav-link" href="{{ route('admin.categories') }}">Category</a>
                        <a class="nav-link" href="{{ route('admin.model') }}">Product Models</a>
                        <a class="nav-link" href="{{ route('admin.unit') }}">Product Units</a>
                        <a class="nav-link" href="{{ route('admin.products') }}">Product</a>
                        <a class="nav-link" href="{{ route('service') }}">Our Speciality</a>
                        <a class="nav-link" href="{{ route('edit.factory') }}">Factory Information</a>
                        <a class="nav-link" href="{{ route('whatwe.edit') }}">History & Activity</a>
                        <a class="nav-link" href="{{ route('sister') }}">Sister Concern</a>
                        <a class="nav-link" href="{{ route('faq.index') }}">Faq</a>
                        <a class="nav-link" href="{{ route('admin.event') }}">Gallery Events</a>
                        <a class="nav-link" href="{{ route('galleries') }}">Gallery</a>
                        <a class="nav-link" href="{{ route('videos') }}">Video</a>
                        <a class="nav-link" href="{{ route('testimonial.index') }}">Certification</a>
                        <a class="nav-link" href="{{ route('management.index') }}">Management</a>
                        <a class="nav-link" href="{{ route('partner.index') }}">Client</a>
                        <a class="nav-link" href="{{ route('news') }}">News & Events</a>
                        <a class="nav-link" href="{{ route('map.edit') }}">Map</a>
                    </nav>
                </div>

                {{-- <a class="nav-link {{ ($pageName == 'message' || $pageName == 'query') ? 'active' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                    Messages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> --}}
                {{-- <div class="collapse {{ ($pageName == 'message' || $pageName == 'query') ? 'show' : '' }}" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.query') }}">Customer Query</a>
                        <a class="nav-link" href="{{ route('admin.message') }}">Message</a>
                    </nav>
                </div> --}}
                <a class="nav-link {{ ($pageName == 'all' || $pageName == 'pending' || $pageName == 'cancelled' || $pageName == 'completed') ? 'active' : 'collapsed' }} " href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
                    <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                    Orders
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'all' || $pageName == 'pending' || $pageName == 'cancelled' || $pageName == 'completed') ? 'show' : '' }}" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('order.all') }}">All</a>
                        <a class="nav-link" href="{{ route('order.pending') }}">Pending</a>
                        <a class="nav-link" href="{{ route('order.completed') }}">Completed</a>
                        <a class="nav-link" href="{{ route('order.cancelled') }}">Cancelled</a>
                    </nav>
                </div>
                <a class="nav-link {{ ($pageName == 'contact' || $pageName == 'order') ? 'active' : 'collapsed' }} " href="#" data-toggle="collapse" data-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts4">
                    <div class="sb-nav-link-icon"><i class="far fa-envelope"></i></div>
                    Messages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'contact' || $pageName == 'order') ? 'show' : '' }}" id="collapseLayouts4" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        {{-- <a class="nav-link" href="{{ route('admin.message') }}">Order Message</a> --}}
                        <a class="nav-link" href="{{ route('contact.list') }}">Customer Message</a>
                    </nav>
                </div>
                <a class="nav-link {{ ($pageName == 'profile' || $pageName == 'register') ? 'active' : 'collapsed' }} " href="#" data-toggle="collapse" data-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts5">
                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                    Authentication
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'profile' || $pageName == 'register') ? 'show' : '' }}" id="collapseLayouts5" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('register.create') }}">Add New User</a>
                        <a class="nav-link" href="{{ route('settings') }}">Update Profile</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('logout') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-power-off"></i></div>
                    Sign Out 
                </a>
            </div>
        </div>
    </nav>
</div>