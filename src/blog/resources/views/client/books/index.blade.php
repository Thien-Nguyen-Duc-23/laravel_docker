@extends('client.layout.app')

@section('content')
<div class="container-wrapper">
        <nav id="breadcrumb" class="woocommerce-breadcrumb breadcrumb-book-review" itemprop="breadcrumb">
            <span aria-hidden="true" class="fa fa-home"></span>
            <a href="{{ route('index') }}">@lang('home.lbHome')</a>
            <em class="delimiter">/</em>
            @lang('home.lbGoodReviewBook')
        </nav>
        <header class="woocommerce-products-header">
            <h1 class="woocommerce-products-header__title page-title">@lang('home.lbGoodReviewBook')</h1></header>
        <div class="woocommerce-notices-wrapper"></div>
        <p class="woocommerce-result-count"></p>
        <form class="woocommerce-ordering" method="GET" action="{{ route('book.index') }}">
            <select onchange="this.form.submit()" name="orderby" class="orderby" aria-label="Shop order">
                <option value="latest" {{ $orderBy == 'latest' ? 'selected' : '' }}>@lang('home.lbLatest')</option>
                <option value="comment" {{ $orderBy == 'comment' ? 'selected' : '' }}>@lang('home.lbComment')</option>
                <option value="rating" {{ $orderBy == 'rating' ? 'selected' : '' }}>@lang('home.lbRating')</option>
            </select>
        </form>
        <div class="clearfix"></div>
        <ul class="products columns-3">
            @foreach ($books as $item)
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
            {{ $books->links() }}
    </div>
@endsection
