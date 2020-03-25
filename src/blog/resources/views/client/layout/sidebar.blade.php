<div class="theiaStickySidebar">
    <div id="woocommerce_product_search-2" class="container-wrapper widget woocommerce widget_product_search">
        <div class="widget-title the-global-title">
            <h4>@lang('home.lbSearchBook')<span class="widget-title-icon fas fa-folder"></span></h4></div>
            <form role="search" class="typeahead style-form" action="{{ route('search.index') }}" method="GET">
                <label class="screen-reader-text" for="woocommerce-product-search-field-0">@lang('home.btnSearch')</label>
                <input type="name" id="name woocommerce-product-search-field-0" class="search-input style-input" autocomplete="off" placeholder="@lang('home.txtSearch')" value="{{ Session::get('valueSearch') }}" name="value">
                <button type="submit" class="style-button" value="Tìm kiếm">@lang('home.btnSearch')</button>
            </form>
        <div class="clearfix"></div>
    </div>

    <div id="woocommerce_product_categories-2" class="container-wrapper widget woocommerce widget_product_categories">
        <div class="widget-title the-global-title">
            <h4>@lang('home.lbReviewCategory')<span class="widget-title-icon fas fa-folder"></span></h4>
        </div>
        <ul class="product-categories">
            @foreach($items as $item)
                <li class="cat-item cat-item-541 cat-parent">
                    <a href="{{ route('client.category.index', $item->slug) }}">{{ $item->name }}</a>
                    <ul class="children">
                        @if (Request::segment(2) == $item->slug)
                            @foreach($item['children'] as $child)
                                <li class="cat-item cat-item-542">
                                    <a href="{{ route('client.category.child_category', [$item->slug, $child->slug]) }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endforeach
        </ul>
        <div class="clearfix"></div>
    </div>
    <div id="woocommerce_products-2" class="container-wrapper widget woocommerce widget_products">
        <div class="widget-title the-global-title">
            <h4>@lang('home.lbSuggest')<span class="widget-title-icon fas fa-folder"></span></h4></div>
        <ul class="product_list_widget">
            @foreach ($bookView as $item)
                <li>
                    <a href="{{ route('book.show', $item->slug) }}" title="{{ $item->title }}">
                        @php
                            $imageBook = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                        @endphp
                        <img width="217" height="500" src="{{ $imageBook }}" style="height:70px" alt="">
                        <span class="product-title">{{ $item->short_title }}</span>
                    </a>
                    @if ($item->star != 0)
                        @php $rating = $item->star; @endphp
                        @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if($rating >0)
                                    @if($rating >0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                        @endforeach
                    @else
                        <span class="fa-stack" style="width:1em">
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>
        <div class="clearfix"></div>
    </div>

    <div id="posts-list-widget-21" class="container-wrapper widget posts-list">
        <div class="widget-title the-global-title">
            <h4>@lang('home.lbGoobList')<span class="widget-title-icon fas fa-folder"></span></h4></div>
        <div class="posts-list-bigs">
            <ul class="posts-list-items">
                @foreach ($books->sortBy('star')->take(3) as $item)
                    <li class="widget-post-list tie-standard">
                        <div class="post-widget-thumbnail">
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
                                    $image = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                                @endphp
                                <img width="390" height="220" src="{{ $image }}" class="attachment-jannah-image-large size-jannah-image-large wp-post-image" alt="">
                            </a>
                        </div>
                        <div class="post-widget-body ">
                            <h3 class="post-title">
                                <a href="{{ route('book.show', $item->slug) }}" title="{{ $item->title }}">{{ $item->title }}</a>
                            </h3>
                            <div class="post-meta"> <span class="date meta-item"><span class="far fa-clock" aria-hidden="true"></span> <span>{{ $item->format_date }}</span></span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
