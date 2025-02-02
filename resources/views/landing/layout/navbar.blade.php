<header id="header" class="full-header">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo ============================================= -->
                <div id="logo">
                    <a href="" class="standard-logo" data-dark-logo="{{ asset('front/images/logo-dark.png') }}"><img
                            src="{{ asset('front/images/harsa_logo.png') }}" alt="Canvas Logo"></a>
                    <a href="" class="retina-logo" data-dark-logo="{{ asset('front/images/logo-dark@2x.png') }}"><img
                            src="{{ asset('front/images/harsa_logo@2x.png') }}" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div class="header-misc">



                </div>

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                        <path
                            d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                        </path>
                        <path d="m 30,50 h 40"></path>
                        <path
                            d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                        </path>
                    </svg>
                </div>

                <!-- Primary Navigation ============================================= -->
                <nav class="primary-menu">

                    <ul class="menu-container one-page-menu" data-easing="easeInOutExpo" data-speed="1500">
                        <li class="menu-item {{ request()->segment(1) == '' ? 'current' : '' }}"><a class="menu-link"
                                href="{{ route('landing') }}">
                                <div>Home</div>
                            </a></li>
                        <li class="menu-item sub-menu">
                            <a class="menu-link" href="" style="padding-top: 19px; padding-bottom: 19px;">
                                <div>About<i class="icon-angle-down"></i></div>
                            </a>
                            <ul class="sub-menu-container" style="">
                                @forelse ($abouts as $aboutNav)
                                    <li class="menu-item" style="">
                                        <a class="menu-link" href="{{ route('landing.about', $aboutNav->slug) }}">
                                            <div>{{ $aboutNav->title }}</div>
                                        </a>
                                    </li>
                                @empty

                                @endforelse

                            </ul>
                        </li>

                        <li class="menu-item {{ request()->segment(1) == 'projects' ? 'current' : '' }}"><a
                                class="menu-link" href="{{ route('landing.project') }}">
                                <div>Projects</div>
                            </a></li>
                        <li class="menu-item {{ request()->segment(1) == 'teams' ? 'current' : '' }}"><a
                                class="menu-link" href="{{ route('landing.team') }}">
                                <div>Team</div>
                            </a></li>

                        <li class="menu-item {{ request()->segment(1) == 'gallery' ? 'current' : '' }}"><a
                                class="menu-link" href="{{ route('landing.gallery') }}">
                                <div>Gallery</div>
                            </a></li>

                        <li class="menu-item {{ request()->segment(1) == 'blog' ? 'current' : '' }}"><a
                                class="menu-link" href="{{ route('landing.blog') }}">
                                <div>Blog</div>
                            </a></li>


                    </ul>

                </nav><!-- #primary-menu end -->



            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header>
