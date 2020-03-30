<div id="footer-widgets-container">
<div class="container">
    <div class="footer-widget-area footer-boxed-widget-area">
        <div class="tie-row">
            <div class="tie-col-sm-4 normal-side">
                <div id="author-bio-widget-2" class="container-wrapper widget aboutme-widget">
                    <div class="widget-title the-global-title">
                        <h4>@lang('home.lbAboutUs')
                            <span class="widget-title-icon fa"></span>
                        </h4>
                    </div>
                    <div class="about-author about-content-wrapper is-centered">
                        <img alt="" src="{{ asset("client/images/logo/logo-ver3.png") }}" class="about-author-img" width="280" height="47">
                            <div class="aboutme-widget-content">
                                <span style="text-align:left;">@lang('home.aboutUsContent')</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tie-col-sm-4 normal-side">
                    <div id="posts-list-widget-24" class="container-wrapper widget posts-list">
                        <div class="widget-title the-global-title">
                            <h4>@lang('home.lbLatestUpdates')
                                <span class="widget-title-icon fa"></span>
                            </h4>
                        </div>
                        <div class="timeline-widget">
                            <ul class="posts-list-items">
                                @foreach ($items as $item)
                                <li>
                                    <a href="{{ route('book.show', $item->slug) }}">
                                        <span class="date meta-item">
                                            <span class="fa fa-clock" aria-hidden="true"></span>
                                            <span>{{ $item->diff_now }}</span>
                                        </span>
                                        <h3>{{ $item->title }}</h3>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tie-col-sm-4 normal-side">
                    <div id="pages-2" class="container-wrapper widget widget_pages">
                        <div class="widget-title the-global-title">
                            <h4>@lang('home.lbPages')
                                <span class="widget-title-icon fa"></span>
                            </h4>
                        </div>
                        <ul>
                            <li class="page_item page-item-28369">
                                <a href="/">@lang('home.policy')</a>
                            </li>
                            <li class="page_item page-item-11533">
                                <a href="/">@lang('home.intro')</a>
                            </li>
                            <li class="page_item page-item-10396">
                                <a href="/">@lang('home.lbContact')</a>
                            </li>
                            <li class="page_item page-item-43392">
                                <a href="/">@lang('home.book')</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="site-info" class="site-info site-info-layout-2">
    <div class="container">
        <div class="tie-row">
            <div class="tie-col-md-12">
                <div class="copyright-text copyright-text-first">© Copyright 2019, Vnwriter Inc</div>
                <div class="copyright-text copyright-text-second">Powered by 7leaf</div>
            </div>
        </div>
    </div>
</div>
