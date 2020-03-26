@extends('client.layout.app')

@section('title')
    {{ $getCategory->name }}
@endsection

@section('content')
    <div class="container-wrapper">
        <nav id="breadcrumb" class="woocommerce-breadcrumb breadcrumb-book-review" itemprop="breadcrumb">
            <span aria-hidden="true" class="fa fa-home"></span>
            <a href="">Trang chủ</a>
            <em class="delimiter">/</em>
            <a href="">Review sách hay</a>
            <em class="delimiter">/</em>{{ $getCategory->name }}
        </nav>
        <header class="woocommerce-products-header">
            <h1 class="woocommerce-products-header__title page-title">{{ $getCategory->name }}</h1></header>
        <div class="woocommerce-notices-wrapper"></div>
        <form class="woocommerce-ordering" method="get">
            <select name="orderby" class="orderby" aria-label="Shop order">
                <option value="popularity">Thứ tự theo mức độ phổ biến</option>
                <option value="rating" selected="selected">Thứ tự theo điểm đánh giá</option>
                <option value="date">Mới nhất</option>
                <option value="price">Thứ tự theo giá: thấp đến cao</option>
                <option value="price-desc">Thứ tự theo giá: cao xuống thấp</option>
            </select>
            <input type="hidden" name="paged" value="1">
        </form>
        <div class="clearfix"></div>
        <ul class="products columns-3">
                @foreach ($getCategory->book as $item)
                <li class="product-category product li-custom">
                        <a href="{{ route('book.show', $item->slug) }}">
                            @php
                                $imageBook = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                            @endphp
                            <div class="product-img"><img width="217" height="300" src="{{ $imageBook }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></div>
                            <h2 class="woocommerce-loop-product__title" style="height:46px" title="{{ $item->title }}">
                                {{ $item->short_title }}
                            </h2>
                        </a>

                        <div class="start-rating-custom">
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

                            <div class="tie-alignright commemt-custom">
                                <span class="meta-comment meta-item">
                                    <span class="fa fa-comments" aria-hidden="true"></span> {{ $item->comment->where('status', config('define.active'))->count() }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('book.show', $item->slug) }}" data-quantity="1" class="button product_type_simple" data-product_id="55997" data-product_sku="" aria-label="Đọc thêm về “Giáo Dục Não Phải - Tương Lai Cho Con Bạn”" rel="nofollow">@lang('home.readMore')</a>
                    </li>
                @endforeach
        </ul>
    </div>
@endsection
