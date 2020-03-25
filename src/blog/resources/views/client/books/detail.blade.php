@extends('client.layout.app')

@section('content')
<div class="container-wrapper">
        <nav id="breadcrumb" class="woocommerce-breadcrumb" itemprop="breadcrumb">
            <span aria-hidden="true" class="fa fa-home"></span>
            <a href="{{ route('index') }}">@lang('home.lbHome')</a>
            <em class="delimiter">/</em>
            <a href="{{ route('book.index') }}">@lang('home.lbGoodReviewBook')</a>
            <em class="delimiter">/</em>
            @if (! is_null($book->category->parent))
                <a href="{{ route('client.category.index', $book->category->parent->slug) }}">{{ $book->category->parent->name }}</a>
                <em class="delimiter">/</em>
                <a href="{{ route('client.category.child_category', [$book->category->parent->slug, $book->category->slug]) }}">{{ $book->category->name }}</a>
            @else
                <a href="{{ route('client.category.index', $book->category->slug) }}">{{ $book->category->name }}</a>
            @endif
            <em class="delimiter">/</em>{{ $book->title }}
        </nav>
        <div class="woocommerce-notices-wrapper"></div>
        <div id="product-19511" class="product type-product post-19511 status-publish first instock product_cat-sach-van-hoc product_cat-trinh-tham product_tag-nxb-tre has-post-thumbnail shipping-taxable product-type-simple">
            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;">
                <figure class="woocommerce-product-gallery__wrapper">
                    <div data-thumb="#" data-thumb-alt="" class="woocommerce-product-gallery__image" style="position: relative; overflow: hidden;">
                        @php
                            $imageBook = \Storage::disk('public')->exists('/admin/books/'.$book->conver) ? \Storage::url('admin/books/'.$book->conver) : asset('admin/images/no-image.png');
                        @endphp
                        <img width="450" height="652" src="{{ $imageBook }}" class="wp-post-image"  title="" sizes="(max-width: 450px) 100vw, 450px">
                    </div>
                </figure>
            </div>
            <div class="summary entry-summary">
                <h1 class="product_title entry-title">{{ $book->title }}</h1>
                <div class="woocommerce-product-rating">
                    <span style="width:86.6%">
                        @if ($book->star == 0)
                            <span>@lang('home.noReview')</span>
                        @else
                            <div class="start-rating-custom">
                                @php $rating = $book->star; @endphp
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
                            </div>
                            <span>
                                    (<strong class="rating">{{ $book->star }}</strong> / 5 @lang('home.baseOn')
                                    <span class="rating">{{ $book->rate->count() }}</span> @lang('home.reviews'))
                            </span>
                        @endif
                    </span>

                <a class="woocommerce-review-link" rel="nofollow"><i class="fas fa-eye"></i> {{ $book->view_count }}</a>
                </div>
                <p class="price"></p>
                <div class="woocommerce-product-details__short-description">
                    <p>{{ $book->discription }}</p>
                    <p>&nbsp;</p>
                    <div id="toc" class="toc"></div>
                </div>
                <div class="woocommerce-product-details__short-description">
                    <a class="dropbtn-rvbook" href="#reviews" style="display: inline-block; height: 37px;">@lang('home.lbReadComment')</a>
                        @php
                            $confimFollow = trans('home.comfirmFollow');
                            $comfirmUnfollow = trans('home.confirmUnfollow');
                            $urlFollow = route('store.index');
                        @endphp
                        @if (Auth::guard('client')->check())
                            <div class="active{{ $book->id }}" style="display: inline-block;">
                                @if ($bookmart !=null && $bookmart->user_id == Auth::guard('client')->user()->userInformation->id)
                                    @php
                                        $urlUnFollow = route('delete.index', [$bookmart->id, $book->id]);
                                    @endphp
                                    <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" onclick="return follow_or_unfollow({{ $book->id }}, {{ $bookmart->id }},'follow', '{{ $comfirmUnfollow }}', '{{ $urlUnFollow}}')">@lang('home.lbFollowing')</a>
                                @else
                                    <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" onclick="return follow_or_unfollow({{ $book->id }} , 0,'following', '{{ $confimFollow }}', '{{ $urlFollow }}')">@lang('home.lbFollow')</a>
                                @endif
                            </div>
                        @else
                            <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" href="{{ route('login.index') }}">@lang('home.lbFollow')</a>
                        @endif
                </div>
                <div class="product_meta">
                    <span class="posted_in">@lang('home.lbCategory')
                        @if (! is_null($book->category->parent))
                            <a href="{{ route('client.category.index', $book->category->parent->slug) }}" rel="tag">{{ $book->category->parent->name }}</a>,
                            <a href="{{ route('client.category.child_category', [$book->category->parent->slug, $book->category->slug]) }}" rel="tag">{{ $book->category->name }}</a>
                        @else
                            <a href="{{ route('client.category.index', $book->category->slug) }}" rel="tag">{{ $book->category->name }}</a>
                        @endif

                    </span>
                    <span class="posted_in">ISBN:
                        <a href="" rel="tag">{{ $book->isbn }}</a>
                    </span>
                </div>
            </div>
            <div class="woocommerce-tabs wc-tabs-wrapper">
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--additional_information panel entry-content wc-tab" id="tab-additional_information" role="tabpanel" aria-labelledby="tab-title-additional_information">
                    <table class="woocommerce-product-attributes shop_attributes">
                        <tbody>
                            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_tac-gia-reader">
                                <th class="woocommerce-product-attributes-item__label">@lang('home.lbAuthor')</th>
                                <td class="woocommerce-product-attributes-item__value">
                                    <p><a href="" rel="tag">{{ $book->author }}</a></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                    {!! $book->content !!}
                    <br> ——————————–</p>
                </div>
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content wc-tab" id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
                    <div id="reviews" class="woocommerce-Reviews">
                        <div id="rating">
                            <div class="alert alert-danger" id="alert-rating" style="display:none"></div>
                            <form class="form-star-rating">
                                @if (Auth::guard('client')->check())
                                    @php
                                        $star = null;
                                    @endphp
                                    @foreach ($book->rate as $item)
                                        @if ($item->userInfo->id == Auth::guard('client')->user()->userInformation->id)
                                            @php
                                                ! is_null($item->star) ? $star = $item->star : $star;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if (!is_null($star))
                                        <div class="rating-form">
                                            <h2 for="rating" id="your-review-label">&#9733; @lang('home.yourReview')</h2>
                                            <div class="star-rating-custom">
                                                <input type="radio" id="5-stars" name="rating" value="5" disabled {{ $star == 5.0 ? 'checked' : '' }} />
                                                <label for="5-stars" title="@lang('home.veryGood')" class="star">&#9733;</label>
                                                <input type="radio" id="4-stars" name="rating" value="4" disabled {{ $star == 4.0 ? 'checked' : '' }} />
                                                <label for="4-stars" title="@lang('home.good')" class="star">&#9733;</label>
                                                <input type="radio" id="3-stars" name="rating" disabled {{ $star == 3.0 ? 'checked' : '' }} value="3" />
                                                <label for="3-stars" title="@lang('home.medium')" class="star">&#9733;</label>
                                                <input type="radio" id="2-stars" name="rating" disabled {{ $star == 2.0 ? 'checked' : '' }} value="2" />
                                                <label for="2-stars" title="@lang('home.bad')" class="star">&#9733;</label>
                                                <input type="radio" id="1-star" name="rating" disabled {{ $star == 1.0 ? 'checked' : '' }} value="1" />
                                                <label for="1-star" title="@lang('home.veryBad')" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rating-form">
                                            <h2 for="rating" id="your-review-label">&#9733; @lang('home.yourReview')</h2>
                                            <div class="star-rating-custom">
                                                <input type="radio" id="5-stars" name="rating" value="5"  />
                                                <label for="5-stars" title="@lang('home.veryGood')" class="star">&#9733;</label>
                                                <input type="radio" id="4-stars" name="rating" value="4" />
                                                <label for="4-stars" title="@lang('home.good')" class="star">&#9733;</label>
                                                <input type="radio" id="3-stars" name="rating" value="3" />
                                                <label for="3-stars" title="@lang('home.medium')" class="star">&#9733;</label>
                                                <input type="radio" id="2-stars" name="rating" value="2" />
                                                <label for="2-stars" title="@lang('home.bad')" class="star">&#9733;</label>
                                                <input type="radio" id="1-star" name="rating" value="1" />
                                                <label for="1-star" title="@lang('home.veryBad')" class="star">&#9733;</label>
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::guard('client')->user()->userInformation->id }}">
                                            </div>
                                            <div class="submit-rating">
                                                @php
                                                    $confirm = trans('home.confirmRating');
                                                    $alert = trans('home.alertRating');
                                                @endphp
                                                <button name="submit" type="button" onclick="return getRate('{{ $confirm }}', '{{ $alert }}', '{{ route('book.rate') }}')" id="submit-rating-button" class="button">@lang('home.btnSend')</button>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="rating-form">
                                        <h2 for="rating" id="your-review-label">&#9733; @lang('home.yourReview')</h2>
                                        <div class="star-rating-custom">
                                            <input type="radio" id="5-stars" name="rating" value="5"  />
                                            <label for="5-stars" title="@lang('home.veryGood')" class="star">&#9733;</label>
                                            <input type="radio" id="4-stars" name="rating" value="4" />
                                            <label for="4-stars" title="@lang('home.good')" class="star">&#9733;</label>
                                            <input type="radio" id="3-stars" name="rating" value="3" />
                                            <label for="3-stars" title="@lang('home.medium')" class="star">&#9733;</label>
                                            <input type="radio" id="2-stars" name="rating" value="2" />
                                            <label for="2-stars" title="@lang('home.bad')" class="star">&#9733;</label>
                                            <input type="radio" id="1-star" name="rating" value="1" />
                                            <label for="1-star" title="@lang('home.veryBad')" class="star">&#9733;</label>
                                        </div>
                                        <div class="submit-rating">
                                            <a href="{{ route('login.index') }}" class="button" id="submit">@lang('home.btnSend')</a>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div id="reviews" class="woocommerce-Reviews">
                        <div id="comments">
                            <h2 class="woocommerce-Reviews-title"> {{ $comments->total() }} {{ $comments->total() < 2 ? trans('home.comment') : trans('home.comments') }}</h2>
                            <ol class="commentlist">
                                @foreach ($comments as $comment)
                                    <li class="review depth-1" id="li-comment-7994">
                                        <div id="comment-7994" class="comment_container">
                                            <div class="comment-text">
                                                <p class="meta">
                                                @php
                                                    $avatar = \Storage::disk('public')->exists('/admin/accounts/'.$comment->userInfo->avatar) ? \Storage::url('admin/accounts/'.$comment->userInfo->avatar) : asset('admin/images/no-image.png');
                                                @endphp
                                                    <img src="{{ $avatar }}" width="40" id="avatar-comment">
                                                    <span id="author-comment">
                                                        <strong class="woocommerce-review__author">{{ $comment->userInfo->full_name }} </strong>
                                                        <span class="woocommerce-review__dash">–</span>
                                                        <time class="woocommerce-review__published-date" datetime="{{ $comment->created_at }}"> {{ $comment->created_at }}</time>
                                                    </span>
                                                    <div class="clear"></div>
                                                </p>
                                                <div class="description">
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                        @if ($comments->total() > $comments->perPage())
                            <div id="paginate-comment">
                                {{ $comments->links() }}
                            </div>
                        @else
                            <div id="paginate-comment2"></div>
                        @endif

                        <div id="review_form_wrapper">
                            <div id="review_form">
                                <div id="add-comment-block" class="container-wrapper">
                                        <div class="alert alert-danger" id="alert-comment" style="display:none"></div>
                                    <div id="respond" class="comment-respond"> <span id="reply-title" class="comment-reply-title">@lang('home.addReview') <small><a rel="nofollow" id="cancel-comment-reply-link" href="/book/an-mang-tren-chuyen-tau-toc-hanh-phuong-dong#respond" style="display:none;">Hủy</a></small></span>
                                        <form  id="commentform" class="comment-form">
                                            <p class="comment-form-comment">
                                                <textarea id="comment" name="comment" cols="45" rows="8" ></textarea>
                                            </p>

                                            <p class="form-submit">
                                                @if (Auth::guard('client')->check())
                                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::guard('client')->user()->userInformation->id }}">
                                                    @php
                                                        $lang = trans('home.commentModeration');
                                                        $avatar = asset('storage/admin/accounts/'.Auth::guard('client')->user()->userInformation->avatar);
                                                        $name = Auth::guard('client')->user()->userInformation->full_name;
                                                    @endphp
                                                    <button name="submit" type="button" onclick="return getComment('{{ $lang }}', '{{ $avatar }}', '{{ $name }}', '{{ route('book.comment') }}')" id="submit" class="button">@lang('home.btnSend')</button>
                                                @else
                                                    <a href="{{ route('login.index') }}" class="button" id="submit">@lang('home.btnSend')</a>
                                                @endif
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
