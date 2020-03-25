@php
    $confimFollow = trans('home.comfirmFollow');
    $comfirmUnfollow = trans('home.confirmUnfollow');
    $urlFollow = route('store.index');
@endphp
@if ($bookmart !=null && $bookmart->user_id == Auth::guard('client')->user()->userInformation->id)
    @php
        $urlUnFollow = route('delete.index', [$bookmart->id, $idBook]);
    @endphp
    <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" onclick="return follow_or_unfollow({{ $idBook }}, {{ $bookmart->id }},'follow', '{{ $comfirmUnfollow }}', '{{ $urlUnFollow }}')">@lang('home.lbFollowing')</a>
@else
    <a class="dropbtn-rvbook" style="display: inline-block; height: 37px;" onclick="return follow_or_unfollow({{ $idBook }}, 0,'following', '{{ $comfirmFollow }}', '{{ $urlFollow }}')">@lang('home.lbFollow')</a>
@endif
