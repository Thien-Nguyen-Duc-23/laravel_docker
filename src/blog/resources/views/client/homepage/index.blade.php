@extends('client.layout.app')

@section('main')
<div id="tiepost-43392-section-6754" class="section-wrapper container-full without-background">
    <div class="section-item is-first-section full-width" style="">
        <div class="container">
            <div class="tie-row main-content-row">
                <div class="main-content tie-col-md-12">
                    <div id="tie-block_578" class="mag-box block-custom-content">
                        <div class="container-wrapper">
                            <div class="mag-box-title the-global-title">
                                <h3> @lang('home.readWeek')</h3>
                            </div>
                            <div class="mag-box-container clearfix">
                                <div class="entry">
                                    <h2>
                                        @php
                                            $image = \Storage::disk('public')->exists('/admin/books/'.$getABook->conver) ? \Storage::url('admin/books/'.$getABook->conver) : asset('admin/images/no-image.png');
                                        @endphp
                                        <img class="alignleft" src="{{ $image }}" width="170" height="258" />
                                        <a href="{{ route('book.show', $getABook->slug) }}">{{ $getABook->title }}</a>
                                    </h2>
                                    <p>{{ $getABook->short_desc }}</p>
                                    <p>
                                        <a class="more-link button" href="{{ route('book.show', $getABook->slug) }}">@lang('home.readMore')</a>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tiepost-43392-section-4421" class="section-wrapper container-full without-background has-title">
    <div class="section-item full-width" style="">
        <div class="container">
            <h2 class="section-title section-title-centered">
                <span class="the-section-title">
                    <a href="#" title="@lang('home.bookReview')">@lang('home.bookReview')</a>
                </span>
            </h2>
        </div>
        <div class="container">
            <div class="tie-row main-content-row">
                <div class="main-content tie-col-md-12">
                    <section id="tie-block_1963" class="slider-area mag-box">
                        <div id="tie-main-slider-11-block_1963" class="tie-main-slider main-slider grid-4-slides boxed-slider grid-slider-wrapper tie-slick-slider-wrapper" data-slider-id="11" data-speed="3000">
                            <div class="main-slider-inner">
                                <div class="containerblock_1963">
                                    <div class="tie-slick-slider">
                                        <ul class="tie-slider-nav"></ul>
                                        <div class="slide">
                                            @foreach ($categories as $item)
                                                @php
                                                    $imageCategorie = \Storage::disk('public')->exists('/admin/categories/'.$item->cover) ? \Storage::url('admin/categories/'.$item->cover) : asset('admin/images/no-image.png');
                                                @endphp
                                            <div style="background-image: url({{ $imageCategorie }})" class="grid-item slide-id-1 tie-slide-1">
                                                <a href="{{ route('client.category.index', $item->slug) }}" class="all-over-thumb-link">
                                                    <span class="screen-reader-text">{{ $item->name }}</span>
                                                </a>
                                                <div class="thumb-overlay">
                                                    <div class="thumb-content">
                                                        <h2 class="thumb-title">
                                                            <a href="{{ route('client.category.index', $item->slug) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                                                        </h2>
                                                        <div class="thumb-desc"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tiepost-43392-section-9257" class="section-wrapper container-full has-background">
    <div class="section-item full-width" style="background-color: #ffffff; background-size: cover;">
        <div class="container">
            <div class="tie-row main-content-row">
                <div class="main-content tie-col-md-12">
                    <div id="tie-block_492" class="mag-box big-posts-box content-only">
                        <div class="container-wrapper">
                            <div class="mag-box-title the-global-title">
                                <h3>@lang('home.latest')</h3>
                            </div>
                            <div class="mag-box-container clearfix">
                                <ul class="posts-items posts-list-container">
                                    @foreach ($latestBook as $item)
                                    <li class="post-item  post-49896 post type-post status-publish format-standard has-post-thumbnail category-top-10 category-trich-dan-sach tie-standard">
                                        <a href="{{ route('book.show', $item->slug) }}" title="{{ $item->short_title }}" class="post-thumb">
                                            <h5 class="post-cat-wrap">
                                                <span class="post-cat tie-cat-6">@lang('home.lbGoobList')</span>
                                            </h5>
                                            <div class="post-thumb-overlay-wrap">
                                                <div class="post-thumb-overlay">
                                                    <span class="icon"></span>
                                                </div>
                                            </div>
                                            @php
                                                $imageBook = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                                            @endphp
                                            <img width="390" height="220" src="{{ $imageBook }}" class="attachment-jannah-image-large size-jannah-image-large wp-post-image" alt="" />
                                        </a>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <span class="meta-author meta-item">
                                                    <a href="" class="author-name" title="Vnwriter">
                                                        <span class="fa fa-user" aria-hidden="true"></span> {{ $item->userInformation->full_name }}
                                                    </a>
                                                </span>
                                                <span class="date meta-item">
                                                    <span class="fa fa-clock" aria-hidden="true"></span>
                                                <span>{{ $item->format_date }}</span>
                                                </span>
                                                <div class="tie-alignright">
                                                    <span class="meta-comment meta-item">
                                                        <a href="{{ route('book.show', $item->slug) }}">
                                                            <span class="fa fa-comments" aria-hidden="true"></span> {{ $item->comment->where('status', config('define.active'))->count() }}
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <h3 class="post-title" style="height:60px">
                                                <a href="{{ route('book.show', $item->slug) }}" title="{{ $item->title }}">{{ $item->short_title }}</a>
                                            </h3>
                                            <p class="post-excerpt"  style="height:125px">{{ $item->short_desc }}</p>
                                            <a class="more-link button" href="{{ route('book.show', $item->slug) }}">@lang('home.readMore')</a>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tiepost-43392-section-2626" class="section-wrapper container-full without-background">
    <div class="section-item full-width" style="">
        <div class="container">
            <div class="tie-row main-content-row">
                <div class="main-content tie-col-md-12">
                    <div id="tie-block_2526" class="mag-box small-wide-post-box wide-post-box top-news-box">
                        <div class="container-wrapper">
                            <div class="mag-box-title the-global-title">
                                <h3> @lang('home.selective')</h3>
                            </div>
                            <div class="mag-box-container clearfix">
                                <ul class="posts-items posts-list-container">
                                    @foreach ($getThreeBook as $item)
                                    <li class="post-item  post-26268 post type-post status-publish format-standard has-post-thumbnail category-top-10 category-sach-theo-chu-de tie-standard">
                                        <a href="{{ route('book.show', $item->slug) }}" title="{{ $item->title }}" class="post-thumb">
                                            <h5 class="post-cat-wrap">
                                                <span class="post-cat tie-cat-6">@lang('home.lbGoobList')</span>
                                            </h5>
                                            <div class="post-thumb-overlay-wrap">
                                                <div class="post-thumb-overlay">
                                                    <span class="icon"></span>
                                                </div>
                                            </div>
                                            @php
                                                $imageBook = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                                            @endphp
                                            <img width="390" height="220" src="{{ $imageBook }}" class="attachment-jannah-image-large size-jannah-image-large wp-post-image" alt="" />
                                        </a>
                                        <div class="post-details">
                                            <div class="post-meta">
                                                <span class="meta-author meta-item">
                                                <a href="#" class="author-name" title="{{ $item->userInformation->full_name }}">
                                                    <span class="fa fa-user" aria-hidden="true"></span> {{ $item->userInformation->full_name }}
                                                </a>
                                                </span>
                                                <span class="date meta-item">
                                                    <span class="fa fa-clock" aria-hidden="true"></span>
                                                <span>{{ $item->format_date }}</span>
                                                </span>
                                                <div class="tie-alignright">
                                                    <span class="meta-comment meta-item">
                                                    <a href="#">
                                                        <span class="fa fa-comments" aria-hidden="true"></span> {{ $item->comment->where('status', config('define.active'))->count() }}
                                                    </a>
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <h3 class="post-title">
                                                <a href="{{ route('book.show', $item->slug) }}" title="{{ $item->title }}">{{ $item->title }}</a>
                                            </h3>
                                            <p class="post-excerpt">{{ $item->short_desc }}</p>
                                            <a class="more-link button" href="{{ route('book.show', $item->slug) }}">@lang('home.readMore')</a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
