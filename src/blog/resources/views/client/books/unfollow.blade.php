@php
    $confimFollow = trans('home.comfirmFollow');
    $comfirmUnfollow = trans('home.confirmUnfollow');
@endphp
@if ($bookmart !=null && $bookmart->user_id == Auth::guard('client')->user()->userInformation->id)
    <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" onclick="return follow_or_unfollow({{ $bookId }}, 0,'follow', '{{ $comfirmUnfollow }}')">@lang('home.lbFollowing')</a>
@else
    <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" onclick="return follow_or_unfollow({{ $bookId }}, 0,'following', '{{ $confimFollow }}')">@lang('home.lbFollow')</a>
@endif
