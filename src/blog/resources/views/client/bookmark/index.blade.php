@extends('client.layout.app')

@section('content')
<div class="container-wrapper">
        <nav id="breadcrumb" class="woocommerce-breadcrumb breadcrumb-book-review" itemprop="breadcrumb">
            <span aria-hidden="true" class="fa fa-home"></span>
            <a href="{{ route('index') }}">@lang('home.lbHome')</a>
            <em class="delimiter">/</em>
            @lang('home.lbBookmart')
        </nav>
        <header class="woocommerce-products-header">
            <h1 class="woocommerce-products-header__title page-title">Bookmark</h1></header>
        <div class="woocommerce-notices-wrapper"></div>
        <p class="woocommerce-result-count">@lang('home.lbShow') {{ $bookmarks->total() }} @lang('home.lbResult')</p>
        <div class="clearfix"></div>
        <ul class="products columns-3">
            @foreach ($bookmarks as $item)
                <li class="product-category product li-custom">
                    <a href="{{ route('book.show', $item->book->slug) }}">
                        @php
                            $imageBook = \Storage::disk('public')->exists('/admin/books/'.$item->conver) ? \Storage::url('admin/books/'.$item->conver) : asset('admin/images/no-image.png');
                        @endphp
                        <div class="product-img"><img width="217" height="300" src="{{ $imageBook }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></div>
                        <h2 class="woocommerce-loop-product__title" style="height:46px">
                            {{ $item->book->short_title }}
                        </h2>
                    </a>
                    <a href="{{ route('book.show', $item->book->slug) }}" data-quantity="1" class="button product_type_simple" data-product_id="55997" data-product_sku="" aria-label="Đọc thêm về “Giáo Dục Não Phải - Tương Lai Cho Con Bạn”" rel="nofollow">Đọc tiếp</a>
                </li>
            @endforeach
        </ul>
        {{ $bookmarks->links() }}
    </div>
@endsection
