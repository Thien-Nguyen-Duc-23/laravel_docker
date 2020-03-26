@extends('client.layout.app')

@section('content')
<div class="container-wrapper">
        <nav id="breadcrumb" class="woocommerce-breadcrumb breadcrumb-book-review" itemprop="breadcrumb">
            <span aria-hidden="true" class="fa fa-home"></span>
            <a href="">@lang('home.lbHome')</a>
            <em class="delimiter">/</em>
            <a href="">@lang('home.lbSearchFor') "{{ $value }}"</a>
        </nav>
        <header class="woocommerce-products-header">
            <h1 class="woocommerce-products-header__title page-title">@lang('home.lbSearchFor'): "{{ $value }}"</h1></header>
        <div class="woocommerce-notices-wrapper"></div>
        <p class="woocommerce-result-count">@lang('home.lbShow') {{ $count }} @lang('home.lbResult')</p>
        <form class="woocommerce-ordering" method="get">
            <select name="orderby" class="orderby" aria-label="Shop order">
                <option value="latest">Sort by latest</option>
                <option value="popularity">Sort by comment</option>
                <option value="rating">Sort by rating</option>
            </select>
            <input type="hidden" name="paged" value="1">
        </form>
        <div class="clearfix"></div>
        <ul class="products columns-3">
            @foreach ($getAllBooks as $item)
                <li class="product-category product li-custom">
                    <a href="{{ route('book.show', $item->slug) }}">
                        @php
                            $image = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                        @endphp
                        <div class="product-img"><img width="217" height="300" src="{{ asset('storage/admin/books/'.$item->conver) }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></div>
                        <h2 class="woocommerce-loop-product__title">
                            {{ $item->title }}
                        </h2>
                    </a>
                    <div class="start-rating-custom">
                        @php $rating = 4.5; @endphp

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

                        <div class="tie-alignright commemt-custom">
                            <span class="meta-comment meta-item">
                                <span class="fa fa-comments" aria-hidden="true"></span> 0
                            </span>
                        </div>
                    </div>
                    <a href="" data-quantity="1" class="button product_type_simple" data-product_id="55997" data-product_sku="" aria-label="Đọc thêm về “Giáo Dục Não Phải - Tương Lai Cho Con Bạn”" rel="nofollow">Đọc tiếp</a>
                </li>
            @endforeach
        </ul>
        <div id="paginate-comment">
            {{ $getAllBooks->appends(Request::except('page'))->links() }}
        </div>
    </div>
@endsection
