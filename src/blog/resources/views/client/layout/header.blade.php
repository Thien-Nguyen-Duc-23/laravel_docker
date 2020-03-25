<header id="theme-header" class="theme-header header-layout-1 main-nav-dark main-nav-below has-shadow mobile-header-default">
        <div class="main-nav-wrapper">
            <nav id="main-nav" class="main-nav header-nav" style="line-height:54px" aria-label="Primary Navigation">
                <div class="container">
                    <div class="main-menu-wrapper">
                        <div class="header-layout-1-logo  has-line-height" style="width:188px">
                            <a href="#" id="mobile-menu-icon"> <span class="nav-icon"></span> <span class="screen-reader-text">Danh mục</span> </a>
                            <div id="logo" class="image-logo" style="margin-top: 1px; margin-bottom: 1px;">
                            <a title="Vnwriter.net" href="{{ route('index') }}"> <img src="{{ asset("client/images/logo/logo_v5_book.png") }}" alt="Vnwriter.net" width="188" height="52" style="max-height:52px; width: auto;"> </a>
                            </div>
                        </div>
                        <div id="menu-components-wrap">
                            <div id="sticky-logo" class="image-logo">
                                <a title="Vnwriter.net" href="{{ route('index') }}"> <img src="{{ asset("client/images/logo/logo_v5_book.png") }}" alt="Vnwriter.net"> </a>
                            </div>
                            <div class="flex-placeholder"></div>
                            <div class="main-menu main-menu-wrap tie-alignleft">
                                <div id="main-nav-menu" class="main-menu header-menu">
                                    <ul id="menu-sach-2" class="menu" role="menubar">
                                        <li id="menu-item-55680" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-55680 menu-item-has-icon is-icon-only">
                                            <a title="Trang chủ" href="{{ route('index') }}"> 
                                                <span aria-hidden="true" class="fa fa-home" style="font-size:18px"></span> 
                                                <span class="screen-reader-text">@lang('home.lbHome')</span>
                                            </a>
                                        </li>
                                        <li id="menu-item-44510" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44510"><a href="{{ route('book.index') }}">@lang('home.lbReview')</a></li>
                                    <li id="menu-item-44511" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44511"><a href="{{ route('contacts.index') }}">@lang('home.lbContact')</a></li>
                                        @if (Auth::guard('client')->check())
                                            <li id="menu-item-44507" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44507">
                                                <div class="dropdown btn-change-language">
                                                    <button class="dropbtn">{{ Auth::guard('client')->user()->userInformation->full_name }}</button>
                                                    <div class="dropdown-content">
                                                        <a href="{{ route('client.logout') }}">@lang('home.lbLogout')</a>
                                                        <a href="{{ route('bookmark.index') }}">@lang('home.lbBookmart')</a>
                                                        <a href="{{ route('profile.index') }}">@lang('home.profile')</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                            <li id="menu-item-44507" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44507">
                                                <a href="{{ route('login.index') }}"><i class="far fa-user"></i>  @lang('home.lbLogin')</a>
                                            </li>
                                            <li id="menu-item-44507" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44507">
                                                <a href="{{ route('register.index') }}"> @lang('home.lbRegister')</a>
                                            </li>
                                        @endif
                                        <li id="menu-item-44507" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-44507">
                                            <div class="dropdown btn-change-language">
                                                <button class="dropbtn">
                                                    @if(Session::get('lang') == 'vi')
                                                        @lang('home.lbVietNam')
                                                    @else
                                                        @lang('home.lbEnglish')
                                                    @endif
                                                </button>
                                                <div class="dropdown-content">
                                                    <a href="{!! route('user.change_language', ['en']) !!}">@lang('home.lbEnglish')</a>
                                                    <a href="{!! route('user.change_language', ['vi']) !!}">@lang('home.lbVietNam')</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
</header>
